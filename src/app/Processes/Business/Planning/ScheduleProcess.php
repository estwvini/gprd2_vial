<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Task;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\TaskRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Clase ScheduleProcess
 * @package App\Processes\Business\Planning
 */
class ScheduleProcess
{
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var
     */
    private $projectRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    /**
     * Constructor de ScheduleProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectRepository $projectRepository
     * @param UserRepository $userRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param TaskRepository $taskRepository
     * @param BudgetProjectTrackingRepository $budgetProjectTrackingRepository
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        ProjectRepository $projectRepository,
        UserRepository $userRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        TaskRepository $taskRepository,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->taskRepository = $taskRepository;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
    }

    /**
     * Carga información del proyecto para mostrar en el index
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function index(int $id)
    {
        $fiscal_year = $this->fiscalYearRepository->findNextFiscalYear();

        $project = $this->projectRepository->find($id);
        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscal_year->id, $id);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        return [
            'fiscal_year' => $fiscal_year ? $fiscal_year->year : Carbon::now()->addYear()->year,
            'project' => $project,
            'entity' => $project,
            'projectFiscalYear' => $projectFiscalYear,
            'entity_status' => $projectFiscalYear->status,
            'schedule' => true,
            'replicate' => $this->taskRepository->findByProjectFiscalYear($projectFiscalYear->id)->count() ? false : true
        ];
    }

    /**
     * Carga información de la tabla
     *
     * @param int $projectId
     * @param bool $isPlanning
     *
     * @return array
     * @throws Exception
     */
    public function loadTable(int $projectId, bool $isPlanning)
    {

        $project = $this->projectRepository->find($projectId);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        if ($isPlanning) {
            $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        } else {
            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        }

        if (!$fiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $minDate = new DateTime($project->date_init);
        $maxDate = new DateTime($project->date_end);

        if ($fiscalYear->year != $minDate->format('Y')) {
            $minDate = "01-01-{$fiscalYear->year}";
        } else {
            $minDate = $minDate->format('d-m-Y');
        }

        if ($fiscalYear->year != $maxDate->format('Y')) {
            $maxDate = "31-12-{$fiscalYear->year}";
        } else {
            $maxDate = $maxDate->format('d-m-Y');
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->getProjectFiscalYear($project->id, $fiscalYear->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $projectBudgetItems = collect();
        if (!$isPlanning) {
            $projectBudgetItems = $this->budgetProjectTrackingRepository->findByProjectFiscalYearTotals([$projectFiscalYear->id], $projectFiscalYear->fiscalYear);
        }

        $schedule = $this->buildScheduleStructure($project->id, $projectFiscalYear->id, $isPlanning, $projectBudgetItems ?: collect([]));

        $users = [];
        if ($project->executingUnit) {
            $users = $this->userRepository->findUsersByDepartment($project->executingUnit->id, ['users.id', 'users.first_name', 'users.last_name']);
        }


        return [
            'project' => $project,
            'projectSchedule' => $schedule,
            'relevanceOptions' => ActivityProjectFiscalYear::RELEVANCE_OPTIONS,
            'users' => $users,
            'fiscalYear' => $fiscalYear,
            'minDate' => $minDate,
            'maxDate' => $maxDate
        ];
    }

    /**
     * Contruye estructura del cronograma de un proyecto.
     *
     * @param int $projectId
     * @param int $projectFiscalYearId
     * @param bool $isPlanning
     * @param Collection $budgetItems
     *
     * @return Collection
     */
    public function buildScheduleStructure(int $projectId, int $projectFiscalYearId, bool $isPlanning, Collection $budgetItems)
    {
        $components = collect([]);
        $componentsInfo = $this->projectFiscalYearRepository->getComponentsInfo($projectId, $projectFiscalYearId);

        $componentsInfo->each(function ($component) use (&$components, $projectFiscalYearId, $isPlanning, $budgetItems) {

            $activities = collect([]);
            $component->allActivitiesProjectFiscalYear->each(function ($activityProjectFiscalYear) use (&$activities, $component, $isPlanning, $budgetItems) {

                $budget = $activityProjectFiscalYear->budgetItems->reduce(function ($subtotal, $item) {
                    return $subtotal + $item->amount;
                });

                $tasks = collect([]);
                $activityProjectFiscalYear->tasks->each(function ($task) use (&$tasks, $activityProjectFiscalYear, $isPlanning, $budgetItems) {

                    $editable = true;
                    if (!$isPlanning && in_array($task->status, [Task::STATUS_COMPLETED_ONTIME, Task::STATUS_COMPLETED_OUTOFTIME])) {
                        $editable = false;
                    }

                    $tasks->push([
                        'id' => $task->id,
                        'activity_id' => $activityProjectFiscalYear->id,
                        'type' => $task->type,
                        'name' => $task->name,
                        'budget' => trans('schedule.labels.notApply'),
                        'date_init' => $task->date_init ? Carbon::parse($task->date_init)->format('d-m-Y') : trans('schedule.labels.notApply'),
                        'date_end' => $task->date_end ? Carbon::parse($task->date_end)->format('d-m-Y') : null,
                        'duration' => $task->duration ?? trans('schedule.labels.notApply'),
                        'relevance' => trans('schedule.labels.notApply'),
                        'responsible' => $task->responsible->count() ? $task->responsible->first()->fullName() : '',
                        'responsible_id' => $task->responsible->count() ? $task->responsible->first()->id : null,
                        'weight' => null,
                        'weight_percentage' => number_format((float)$task->weight_percentage, 2, '.', ''),
                        'editable' => $editable
                    ]);
                });

                $affected = false;

                if (!$isPlanning && $budgetItems->where('activityProjectFiscalYear.id', $activityProjectFiscalYear->id)->where('affected', true)->count()) {
                    $affected = true;
                }

                $activities->push([
                    'type' => ActivityProjectFiscalYear::TYPE,
                    'id' => $activityProjectFiscalYear->id,
                    'component_id' => $component->id,
                    'name' => "{$activityProjectFiscalYear->code} - {$activityProjectFiscalYear->name}",
                    'budget' => $budget ? number_format($budget, 2) : 0,
                    'date_init' => $activityProjectFiscalYear->date_init ? Carbon::parse($activityProjectFiscalYear->date_init)->format('d-m-Y') : null,
                    'date_end' => $activityProjectFiscalYear->date_end ? Carbon::parse($activityProjectFiscalYear->date_end)->format('d-m-Y') : null,
                    'duration' => $activityProjectFiscalYear->duration,
                    'relevance' => $activityProjectFiscalYear->relevance,
                    'responsible' => $activityProjectFiscalYear->responsible->count() ? $activityProjectFiscalYear->responsible->first()->fullName() : '',
                    'responsible_id' => $activityProjectFiscalYear->responsible->count() ? $activityProjectFiscalYear->responsible->first()->id : null,
                    'weight' => $activityProjectFiscalYear->weight ?: 0,
                    'weight_percentage' => number_format((float)$activityProjectFiscalYear->weight_percentage, 2, '.', ''),
                    'children' => $tasks,
                    'affected' => $affected
                ]);
            });

            if ($component->allActivitiesProjectFiscalYear->count()) {
                $components->push([
                    'id' => $component->id,
                    'name' => $component->name,
                    'children' => $activities
                ]);
            }

        });

        return $components;
    }

    /**
     * Almacenar una nueva tarea/hito
     *
     * @param Request $request
     *
     * @return void
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $activityProjectFiscalYear = $this->activityProjectFiscalYearRepository->find($data['activity_id']);

        if (!$activityProjectFiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.activity_fiscal_year_not_found'), 1000);
        }

        $requestInfo = self::processTaskRequest($data, $activityProjectFiscalYear->id);

        if (empty($requestInfo)) {
            throw new Exception(trans('schedule.messages.errors.created', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
        }

        $entity = $this->taskRepository->createFromArray($requestInfo);

        if (!$entity) {
            throw new Exception(trans('schedule.messages.errors.created', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
        }
    }

    /**
     * Procesa los datos recibidos antes de almacenar en la base de datos una nueva tarea o hito
     *
     * @param array $data
     * @param int $activityFiscalYearId
     *
     * @return array
     * @throws Exception
     */
    public function processTaskRequest(array $data, int $activityFiscalYearId)
    {
        if (isset($data['date_init'])) {
            $init = DateTime::createFromFormat('d-m-Y', $data['date_init']);
            $data['date_init'] = $init->format('Y-m-d');
        }

        if (isset($data['date_end'])) {
            $end = DateTime::createFromFormat('d-m-Y', $data['date_end']);
            $data['date_end'] = $end->format('Y-m-d');
        }

        if (isset($data['type'])) {
            if ($data['type'] === Task::ELEMENT_TYPE['TASK']) {
                if (isset($data['date_init']) && isset($data['date_end'])) {
                    $date1 = new DateTime($data['date_init']);
                    $date2 = new DateTime($data['date_end']);

                    $diff = $date1->diff($date2);

                    $data['duration'] = $diff->days ?: 1;

                    return [
                        'task' => [
                            'name' => $data['name'],
                            'type' => $data['type'],
                            'activity_project_fiscal_year_id' => $activityFiscalYearId,
                            'date_init' => $data['date_init'],
                            'date_end' => $data['date_end'],
                            'duration' => $data['duration'],
                            'weight_percentage' => $data['weight_percentage']
                        ],
                        'responsible' => [
                            $data['responsible_id'] => [
                                'active' => true,
                                'date_init' => Carbon::today()->toDateString()
                            ],
                        ]
                    ];
                } else {
                    return [];
                }
            } elseif ($data['type'] === Task::ELEMENT_TYPE['MILESTONE']) {
                return [
                    'task' => [
                        'name' => $data['name'],
                        'type' => $data['type'],
                        'activity_project_fiscal_year_id' => $activityFiscalYearId,
                        'date_init' => null,
                        'date_end' => $data['date_end'],
                        'duration' => null,
                        'weight_percentage' => $data['weight_percentage']
                    ],
                    'responsible' => [
                        $data['responsible_id'] => [
                            'active' => true,
                            'date_init' => Carbon::today()->toDateString()
                        ]
                    ]
                ];
            }
        } else {
            return [];
        }
    }

    /**
     * Actualiza una actividad/tarea en la BD
     *
     * @param Request $request
     * @param bool $isPlanning
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, bool $isPlanning)
    {
        $data = $request->all();

        if ($isPlanning) {
            $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        } else {
            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        }

        if (!$fiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        if ($data['type'] === ActivityProjectFiscalYear::TYPE) {
            $entity = $this->activityProjectFiscalYearRepository->find($data['id']);
        } else {
            $entity = $this->taskRepository->find($data['id']);
        }

        if (!$entity) {
            throw  new Exception(trans('schedule.messages.exceptions.not_found', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
        }

        $message = trans('schedule.messages.success.updated', ['element' => trans('schedule.labels.type.' . $data['type'])]);
        $type_message = 'success';
        $haveChildren = 0;

        // Activity
        if ($data['type'] === ActivityProjectFiscalYear::TYPE) {

            if ($entity->tasks) {
                $dateEnd = Carbon::parse($data['date_end']);
                foreach ($entity->tasks as $task) {
                    if ($task['date_init']) {
                        $data_init = Carbon::parse($task['date_init']);
                        if ($dateEnd->lt($data_init)) {
                            $haveChildren = 1;
                            break;
                        }
                    }
                }
            }

            if ($haveChildren) {
                $message = trans('schedule.messages.errors.has_children');
                $type_message = 'warning';
            } else {
                $requestInfo = self::processActivityRequest($data, $entity);

                if (!$this->activityProjectFiscalYearRepository->bulkUpdateFromArray($requestInfo['data'], $requestInfo['entities'])) {
                    throw new Exception(trans('schedule.messages.errors.updated', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
                }
            }
        } else { // Task or milestone

            $activityFiscalYear = $this->activityProjectFiscalYearRepository->find($data['activity_id']);

            if (!$activityFiscalYear) {
                throw new Exception(trans('schedule.messages.exceptions.activity_fiscal_year_not_found'), 1000);
            }

            $requestInfo = self::processTaskRequest($data, $activityFiscalYear->id);

            if (empty($requestInfo)) {
                throw new Exception(trans('schedule.messages.errors.created', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
            }

            $entity = $this->taskRepository->updateFromArray($requestInfo, $entity);

            if (!$entity) {
                throw new Exception(trans('schedule.messages.errors.created', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
            }
        }

        return [
            'message' => $message,
            'type_message' => $type_message,
        ];
    }

    /**
     * Procesa los datos recibidos antes de actualizar en la base de datos una actividad, tarea o hito
     *
     * @param array $data
     * @param ActivityProjectFiscalYear $entity
     *
     * @return array
     * @throws Exception
     */
    public function processActivityRequest(array $data, ActivityProjectFiscalYear $entity)
    {
        if (isset($data['date_init'])) {
            $init = DateTime::createFromFormat('d-m-Y', $data['date_init']);
            $data['date_init'] = $init->format('Y-m-d');
        }

        if (isset($data['date_end'])) {
            $end = DateTime::createFromFormat('d-m-Y', $data['date_end']);
            $data['date_end'] = $end->format('Y-m-d');
        }

        $response = ['data' => [], 'entities' => []];

        if (isset($data['date_init']) && isset($data['date_end'])) {
            $date1 = new DateTime($data['date_init']);
            $date2 = new DateTime($data['date_end']);

            $diff = $date1->diff($date2);

            if (isset($data['responsible_id'])) {
                $data['responsible'] = [
                    $data['responsible_id'] => [
                        'active' => true,
                        'date_init' => Carbon::today()->toDateString()
                    ],
                ];
            }

            $data['duration'] = $diff->days ?: 1;

            $components = $this->projectFiscalYearRepository->getComponentsInfo($data['project_id'], $entity->project_fiscal_year_id);

            $totalWeight = 0;

            $values = $this->activityProjectFiscalYearRepository->findByProjectWithBudgetDurationRelevance($entity->project_fiscal_year_id);

            $values = $values->map(function ($val) use ($data) {
                if ($val->id == $data['id']) {
                    $val->setAttribute('duration', $data['duration']);
                    $val->setAttribute('relevance', $data['relevance']);
                }

                return $val;
            });

            $activities = collect([]);

            $components->each(function ($component) use (&$totalWeight, &$response, &$data, $entity, $values, $activities) {

                $component->allActivitiesProjectFiscalYear->each(function ($activityProjectFiscalYear) use (&$totalWeight, &$data, $entity, $values, $activities) {

                    $budget = $activityProjectFiscalYear->budgetItems->reduce(function ($subtotal, $item) {
                        return $subtotal + $item->amount;
                    });

                    if ($activityProjectFiscalYear->id === $entity->id) {

                        if ($data['relevance'] == 0) {
                            $data['weight'] = 0;
                        } else {
                            $xBudget = self::normalizeValue($values->max('budget'), $values->min('budget'), $budget);
                            $xDuration = self::normalizeValue($values->max('duration'), $values->min('duration'), $data['duration']);
                            $xRelevance = self::normalizeValue((float)$values->max('relevance'), (float)$values->min('relevance'), (float)$data['relevance']);

                            $data['weight'] = ($xBudget + $xDuration + $xRelevance) / 3;
                        }

                        $totalWeight += $data['weight'];
                        $activities->push($entity);
                    } else {

                        if ($activityProjectFiscalYear->relevance == 0) {
                            $activityProjectFiscalYear->weight = 0;
                            $weight = 0;
                        } else {
                            $xBudget = self::normalizeValue($values->max('budget'), $values->min('budget'), $budget);
                            $xDuration = self::normalizeValue($values->max('duration'), $values->min('duration'), $activityProjectFiscalYear->duration);
                            $xRelevance = self::normalizeValue((float)$values->max('relevance'), (float)$values->min('relevance'), (float)$activityProjectFiscalYear->relevance);

                            $weight = ($xBudget + $xDuration + $xRelevance) / 3;
                            $activityProjectFiscalYear->weight = $weight;
                        }
                        $totalWeight += $weight;
                        $activities->push($activityProjectFiscalYear);
                    }
                });
            });

            $activities->each(function ($act) use (&$totalWeight, &$response, &$data, $entity) {
                if ($act->id === $entity->id) {
                    $data['weight_percentage'] = ($data['weight'] * 100) / $totalWeight;
                    $data['project_fiscal_year_id'] = $entity->project_fiscal_year_id;
                    $data['activity_id'] = $entity->id;
                    $response['data'][] = $data;
                    $response['entities'][] = $entity;
                } else {
                    $tmp_data = [
                        'weight_percentage' => (($act->weight ?: 0) * 100) / $totalWeight
                    ];
                    $response['data'][] = $tmp_data;
                    $response['entities'][] = $act;
                }
            });
        }

        return $response;
    }

    /**
     * Normaliza un valor dentro de un conjunto de valores
     *
     * @param float $value
     * @param float $max
     * @param float $min
     *
     * @return float|int
     */
    private function normalizeValue($max, $min, $value = null)
    {
        if (($max - $min) != 0) {
            return $value ? abs(($value - $min) / ($max - $min)) : abs(0 - $min / ($max - $min));
        }
        return 1;
    }

    /**
     * Carga información para generar el diagrama de gantt.
     *
     * @param Request $request
     * @param bool $isPlanning
     *
     * @return array
     * @throws Exception
     */
    public function loadGantt(Request $request, bool $isPlanning)
    {
        $data = $request->all();

        $project = $this->projectRepository->find($data['project_id']);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        if ($isPlanning) {
            $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        } else {
            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        }

        if (!$fiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->getProjectFiscalYear($project->id, $fiscalYear->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $ganttStructure = collect([]);
        $componentsInfo = $this->projectFiscalYearRepository->getComponentsInfo($project->id, $projectFiscalYear->id);

        $componentsInfo->each(function ($component) use (&$ganttStructure, $projectFiscalYear) {

            if ($component->allActivitiesProjectFiscalYear->count()) {
                $ganttStructure->push([
                    'pID' => "component-{$component->id}",
                    'pName' => "{$component->name}",
                    'pRes' => '',
                    'pLink' => '',
                    'pMile' => 0,
                    'pGroup' => 1,
                    'pParent' => 0,
                    'pOpen' => 1,
                    'pDepend' => '',
                    'pCaption' => ''
                ]);
            }

            $component->allActivitiesProjectFiscalYear->each(function ($activityProjectFiscalYear) use (&$ganttStructure, $component) {

                if ($activityProjectFiscalYear->date_init && $activityProjectFiscalYear->date_end) {
                    $ganttStructure->push([
                        'pID' => "activity-{$activityProjectFiscalYear->id}",
                        'pName' => "{$activityProjectFiscalYear->code} - {$activityProjectFiscalYear->name}",
                        'pStart' => Carbon::parse($activityProjectFiscalYear->date_init)->format('Y-m-d'),
                        'pEnd' => Carbon::parse($activityProjectFiscalYear->date_end)->format('Y-m-d'),
                        'pClass' => 'ggroupblack',
                        'pLink' => '',
                        'pMile' => 0,
                        'pRes' => $activityProjectFiscalYear->responsible->count() ? $activityProjectFiscalYear->responsible->first()->fullName() : '',
                        'pGroup' => $activityProjectFiscalYear->tasks->count() ? 1 : 0,
                        'pParent' => "component-{$component->id}",
                        'pOpen' => 1,
                        'pDepend' => '',
                        'pCaption' => ''
                    ]);

                    $activityProjectFiscalYear->tasks->each(function ($task) use (&$ganttStructure, $activityProjectFiscalYear) {
                        $ganttStructure->push([
                            'pID' => "task-{$task->id}",
                            'pName' => $task->name,
                            'pStart' => $task->type === Task::ELEMENT_TYPE['MILESTONE'] ? Carbon::parse($task->date_end)->format('Y-m-d') : Carbon::parse($task->date_init)->format('Y-m-d'),
                            'pEnd' => Carbon::parse($task->date_end)->format('Y-m-d'),
                            'pClass' => $task->type === Task::ELEMENT_TYPE['MILESTONE'] ? 'gtaskred' : 'gtaskblue',
                            'pLink' => '',
                            'pMile' => $task->type === Task::ELEMENT_TYPE['MILESTONE'] ? 1 : 0,
                            'pRes' => $task->responsible->count() ? $task->responsible->first()->fullName() : '',
                            'pGroup' => 0,
                            'pParent' => "activity-{$activityProjectFiscalYear->id}",
                            'pOpen' => 1,
                            'pDepend' => '',
                            'pCaption' => ''
                        ]);
                    });

                }
            });
        });

        return [
            'project' => $project,
            'ganttStructure' => $ganttStructure->count() ? str_replace('\u0022', "\\\\\"", json_encode($ganttStructure, JSON_HEX_APOS | JSON_HEX_QUOT)) : null
        ];
    }

    /**
     * Elimina (lógicamente) una tarea o hito de la BD
     *
     * @param int $id
     * @param Request $request
     *
     * @throws Exception
     */
    public function destroy(int $id, Request $request)
    {
        $data = $request->all();
        $entity = $this->taskRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('schedule.messages.exceptions.not_found', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
        }

        $entity = $this->taskRepository->destroy($entity->id);

        if (!$entity) {
            throw new Exception(trans('schedule.messages.errors.deleted', ['element' => trans('schedule.labels.type.' . $data['type'])]), 1000);
        }

    }

    /**
     * Duplica el cronograma físico de un proyecto
     *
     * @param ProjectFiscalYear $projectFiscalYear
     */
    public function replicateLastYear(ProjectFiscalYear $projectFiscalYear)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentProjectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($currentFiscalYear->id, $projectFiscalYear->project->id);
        $activities = $this->activityProjectFiscalYearRepository->getActivitiesByProject($currentProjectFiscalYear->id);

        foreach ($activities as $activity) {

            $newActivity = ActivityProjectFiscalYear::where([
                ['code', $activity->code],
                ['project_fiscal_year_id', $projectFiscalYear->id]
            ])->firstOr(function () use ($activity, $projectFiscalYear) {
                $trashed = ActivityProjectFiscalYear::withTrashed()->where([
                    ['code', $activity->code],
                    ['project_fiscal_year_id', $projectFiscalYear->id]
                ])->first();

                if (!$trashed && $activity->component) {
                    $dateInit = $activity->date_init ? Carbon::createFromFormat('d-m-Y', $activity->date_init)->addYear(1)->format('Y-m-d') : null;
                    $dateEnd = $activity->date_end ? Carbon::createFromFormat('d-m-Y', $activity->date_end)->addYear(1)->format('Y-m-d') : null;

                    $newActivity = $activity->replicate()->fill([
                        'project_fiscal_year_id' => $projectFiscalYear->id,
                        'date_init' => $dateInit,
                        'date_end' => $dateEnd,
                    ]);
                    $newActivity->save();
                    $newActivity = $newActivity->fresh();
                    if (count($activity->responsible)) {
                        $newActivity->responsible()->sync([
                            $activity->responsible->first()->id => [
                                'active' => true,
                                'date_init' => Carbon::today()->toDateString()
                            ]
                        ]);
                    }
                    return $newActivity;
                } else {
                    return null;
                }
            });

            if ($newActivity) {
                $dateInit = $activity->date_init ? Carbon::createFromFormat('d-m-Y', $activity->date_init)->addYear(1)->format('Y-m-d') : null;
                $dateEnd = $activity->date_end ? Carbon::createFromFormat('d-m-Y', $activity->date_end)->addYear(1)->format('Y-m-d') : null;

                $newActivity->date_init = $dateInit;
                $newActivity->date_end = $dateEnd;

                $newActivity->save();

                foreach ($activity->tasks as $task) {
                    Task::where([
                        ['activity_project_fiscal_year_id', $newActivity->id],
                        ['name', $task->name]
                    ])->firstOr(function () use ($task, $newActivity) {
                        $dateInit = $task->date_init ? Carbon::createFromFormat('d-m-Y', $task->date_init)->addYear(1)->format('Y-m-d') : null;
                        $dateEnd = $task->date_end ? Carbon::createFromFormat('d-m-Y', $task->date_end)->addYear(1)->format('Y-m-d') : null;
                        $newTask = $task->replicate()->fill([
                            'activity_project_fiscal_year_id' => $newActivity->id,
                            'date_init' => $dateInit,
                            'date_end' => $dateEnd,
                            'status' => Task::STATUS_PENDING,
                            'due_date' => null,
                            'beneficiaries' => null
                        ]);
                        $newTask->save();
                        $newTask = $newTask->fresh();
                        if (count($task->responsible)) {
                            $newTask->responsible()->sync([
                                $task->responsible->first()->id => [
                                    'active' => true,
                                    'date_init' => Carbon::today()->toDateString()
                                ]
                            ]);
                        }
                    });
                }
            }
        }
    }

}
