<?php

namespace App\Processes\Business\Tracking;

use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectSchedule;
use App\Models\Business\Project;
use App\Models\Business\Reject;
use App\Models\Business\Task;
use App\Processes\System\FileProcess;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ScheduleRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\TaskRepository;
use App\Repositories\Repository\Business\Tracking\POATrackingRepository;
use App\Repositories\Repository\System\FileRepository;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

/**
 * Clase ProjectPhysicalTrackingProcess
 * @package App\Processes\Business\Planning
 */
class ProjectPhysicalTrackingProcess
{

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var
     */
    protected $projectRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    protected $projectFiscalYearRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    protected $activityProjectFiscalYearRepository;

    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * @var ProjectProcess
     */
    protected $projectProcess;

    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var POATrackingRepository
     */
    private $POATrackingRepository;

    /**
     * Constructor de ProjectPhysicalTrackingProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectRepository $projectRepository
     * @param UserRepository $userRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param TaskRepository $taskRepository
     * @param FileRepository $fileRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param POATrackingRepository $POATrackingRepository
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        ProjectRepository $projectRepository,
        UserRepository $userRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        TaskRepository $taskRepository,
        FileRepository $fileRepository,
        BudgetItemRepository $budgetItemRepository,
        POATrackingRepository $POATrackingRepository
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->taskRepository = $taskRepository;
        $this->fileRepository = $fileRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->POATrackingRepository = $POATrackingRepository;
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
        $fiscal_year = $this->fiscalYearRepository->findCurrentFiscalYear();

        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $project = $projectFiscalYear->project;

        $currentUser = currentUser();
        $projectLeader = $project->activeLeader();
        $isLeader = false;

        if ($projectLeader) {
            $isLeader = $currentUser->id === $projectLeader->id;
        }

        return [
            'fiscal_year' => $fiscal_year->year,
            'project' => $project,
            'isLeader' => $isLeader,
            'currentUser' => $currentUser
        ];
    }

    /**
     * Carga información de la tabla
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function loadTable(Request $request)
    {

        $data = $request->all();

        $project = $this->projectRepository->find($data['project_id']);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->getProjectFiscalYear($project->id, $fiscalYear->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $schedule = $this->buildScheduleStructure($project, $projectFiscalYear->id, $data);

        return [
            'project' => $project,
            'projectSchedule' => $schedule,
            'fiscalYear' => $fiscalYear,
            'semaphore' => $projectFiscalYear->getSemaphore(),
            'projectProgress' => $projectFiscalYear->getProgress(),
            'currentUser' => currentUser(),
            'filters' => [
                'dateFrom' => $data['dateFrom'] ?? '',
                'dateTo' => $data['dateTo'] ?? '',
                'state' => $data['state'] ?? '',
                'activity' => $data['activity'] ?? '',
            ]
        ];
    }

    /**
     * Contruye estructura del cronograma de un proyecto.
     *
     * @param Project $project
     * @param int $projectFiscalYearId
     * @param array $dataFilter
     *
     * @return Collection
     * @throws Exception
     */
    public function buildScheduleStructure(Project $project, int $projectFiscalYearId, array $dataFilter)
    {

        $components = collect([]);
        $date = date_format(Carbon::now(), 'Y-m-d');
        $activityBudget = api_available() ? $this->POATrackingRepository->activitiesBudgetProject($this->fiscalYearRepository->findCurrentFiscalYear()->year, $date) : null;
        $componentsInfo = $this->projectFiscalYearRepository->getComponentsInfoTracking($projectFiscalYearId, $project, $dataFilter);
        $componentsInfo->each(function ($component) use (&$components, $activityBudget, $dataFilter) {
            $activities = collect([]);

            $component->allActivitiesProjectFiscalYear->each(function ($activityProjectFiscalYear) use (&$activities, $component, $activityBudget, $dataFilter) {
                $tasks = collect([]);

                if (!isset($dataFilter['state']) || $dataFilter['state'] == $activityProjectFiscalYear->getSemaphore()) {
                    $activityProjectFiscalYear->tasks->each(function ($task) use (&$tasks, $activityProjectFiscalYear) {

                        $file = $task->files()->first();

                        $targetDate = new DateTime($task->date_init ?: $activityProjectFiscalYear->date_init);
                        $currentDate = new DateTime(Carbon::now());

                        $tasks->push([
                            'id' => $task->id,
                            'activity_id' => $activityProjectFiscalYear->id,
                            'type' => $task->type,
                            'name' => $task->name,
                            'encoded' => '--',
                            'date_init' => $task->date_init ?: trans('schedule.labels.notApply'),
                            'date_end' => $task->date_end,
                            'due_date' => $task->due_date,
                            'attachment' => $file ? $file->id : false,
                            'attachment_date' => $file ? formatDate($file->updated_at, 'd-m-Y') : null,
                            'status' => $task->status,
                            'weight' => number_format($task->weight_percentage, 2, '.', ',') . ' %',
                            'c_progress' => in_array($task->status, [Task::STATUS_COMPLETED_OUTOFTIME, Task::STATUS_COMPLETED_ONTIME]) ? '100 %' : '0 %',
                            'semaphore' => Task::SEMAPHORE[$task->status],
                            'responsible' => $task->responsible->count() ? $task->responsible->first() : '',
                            'rejections' => $task->rejections()->count(),
                            'dateDiff' => $currentDate >= $targetDate
                        ]);
                    });
                    if (api_available()) {
                        $act = $activityBudget->firstWhere('cuenta', $activityProjectFiscalYear->getProgrammaticCode());
                        $encoded = $act ? number_format($act->codificado, 2) : '0.00';
                    } else {
                        $encoded = '--';
                    }


                    $activities->push([
                        'id' => $activityProjectFiscalYear->id,
                        'component_id' => $component->id,
                        'type' => ActivityProjectFiscalYear::TYPE,
                        'name' => "{$activityProjectFiscalYear->code} - {$activityProjectFiscalYear->name}",
                        'encoded' => $encoded,
                        'date_init' => $activityProjectFiscalYear->date_init,
                        'date_end' => $activityProjectFiscalYear->date_end,
                        'due_date' => trans('schedule.labels.notApply'),
                        'attachment' => trans('schedule.labels.notApply'),
                        'attachment_date' => trans('schedule.labels.notApply'),
                        'status' => trans('schedule.labels.notApply'),
                        'weight' => number_format($activityProjectFiscalYear->weight_percentage, 2, '.', ',') . ' %',
                        'c_progress' => $activityProjectFiscalYear->getProgress() . ' %',
                        'semaphore' => $activityProjectFiscalYear->getSemaphore(),
                        'responsible' => $activityProjectFiscalYear->responsible->count() ? $activityProjectFiscalYear->responsible->first() : '',
                        'children' => $tasks
                    ]);
                }
            });

            $components->push([
                'id' => $component->id,
                'name' => $component->name,
                'children' => $activities
            ]);

        });

        return $components;
    }

    /**
     * Muestra la pantalla de registro de avance
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id, Request $request)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            throw  new Exception(trans('physical_progress.messages.exceptions.task_not_found'), 1000);
        }

        $task->load('files');
        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('schedule.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $minDate = $task->date_init ? new DateTime($task->date_init) : new DateTime('01-01-2019'); //. $fiscalYear->year);
        $maxDate = new DateTime();

        return [
            'task' => $task,
            'minDate' => $minDate->format('d-m-Y'),
            'maxDate' => $maxDate->format('d-m-Y'),
            'project_id' => $data['project_id'] ?? ''
        ];
    }

    /**
     * Actualiza un avance en la base de datos
     *
     * @param int $id
     * @param Request $request
     *
     * @throws Exception
     */
    public function update(int $id, Request $request)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            throw  new Exception(trans('physical_progress.messages.exceptions.task_not_found'), 1000);
        }

        $data = $request->all();

        if (isset($data['files']) && $data['files']) {
            foreach ($data['files'] as $file) {
                if ($file) {
                    $fileData['file'] = $file;
                    $fileData['name'] = $file->getClientOriginalName();
                    storeFile($fileData, $task);
                }
            }
        }

        if (isset($data['due_date'])) {
            $dueDate = DateTime::createFromFormat('d-m-Y', $data['due_date']);
            $data['due_date'] = $dueDate->format('Y-m-d');
        }

        $attachment = $task->files()->first();

        if ($attachment && isset($data['due_date'])) {
            $data['status'] = Task::STATUS_TO_REVIEW;
        }

        $this->taskRepository->updateFromArray(['task' => $data], $task);
    }

    /**
     * Elimina un avance en la base de datos
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            throw  new Exception(trans('physical_progress.messages.exceptions.task_not_found'), 1000);
        }

        $attachments = $task->files()->get();

        foreach ($attachments as $attachment) {
            resolve(FileProcess::class)->destroy($attachment->id);
        }

        $this->taskRepository->updateFromArray([
            'task' => [
                'due_date' => null,
                'status' => Task::STATUS_PENDING,
                'beneficiaries' => null
            ]
        ], $task);
    }

    /**
     * Carga información para generar el diagrama de gantt.
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function loadGantt(Request $request)
    {
        $data = $request->all();

        $project = $this->projectRepository->find($data['project_id']);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('physical_progress.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->getProjectFiscalYear($project->id, $fiscalYear->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('physical_progress.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $ganttStructure = collect([]);
        $componentsInfo = $this->projectFiscalYearRepository->getComponentsInfoTracking($projectFiscalYear->id, $project);
        $date = date_format(Carbon::now(), 'Y-m-d');
        $activityBudget = $this->POATrackingRepository->activitiesBudgetProject($this->fiscalYearRepository->findCurrentFiscalYear()->year, $date);

        $componentsInfo->each(function ($component) use (&$ganttStructure, $activityBudget) {
            if ($component->allActivitiesProjectFiscalYear->count()) {
                $ganttStructure->push([
                    'pID' => "component-{$component->id}",
                    'pName' => "{$component->name}",
                    'pRes' => '',
                    'pLink' => '',
                    'pClass' => 'ggroupblack',
                    'pMile' => 0,
                    'pGroup' => 1,
                    'pParent' => 0,
                    'pOpen' => 1,
                    'pDepend' => '',
                    'pCaption' => '',
                    'encoded' => '',
                ]);

                $component->allActivitiesProjectFiscalYear->each(function ($activityProjectFiscalYear) use (&$ganttStructure, $component, $activityBudget) {

                    $act = $activityBudget->firstWhere('cuenta', $activityProjectFiscalYear->getProgrammaticCode());
                    $encoded = $act ? number_format($act->codificado, 2) : '0.00';

                    if ($activityProjectFiscalYear->date_init && $activityProjectFiscalYear->date_end) {
                        $ganttStructure->push([
                            'pID' => "activity-{$activityProjectFiscalYear->id}",
                            'pName' => "{$activityProjectFiscalYear->code} - {$activityProjectFiscalYear->name}",
                            'pStart' => formatDate($activityProjectFiscalYear->date_init, 'Y-m-d'),
                            'pEnd' => formatDate($activityProjectFiscalYear->date_end, 'Y-m-d'),
                            'pClass' => ActivityProjectFiscalYear::GANTT_SEMAPHORE[$activityProjectFiscalYear->getSemaphore()],
                            'pLink' => '',
                            'pMile' => 0,
                            'pRes' => $activityProjectFiscalYear->responsible->count() ? $activityProjectFiscalYear->responsible[0]->fullName() : '',
                            'pGroup' => $activityProjectFiscalYear->tasks->count() ? 1 : 0,
                            'pParent' => "component-{$component->id}",
                            'pOpen' => 1,
                            'pDepend' => '',
                            'pCaption' => '',
                            'pComp' => $activityProjectFiscalYear->getProgress(),
                            'encoded' => $encoded,
                        ]);

                        $activityProjectFiscalYear->tasks->each(function ($task) use (&$ganttStructure, $activityProjectFiscalYear) {
                            $ganttStructure->push([
                                'pID' => "task-{$task->id}",
                                'pName' => $task->name,
                                'pStart' => $task->type === Task::ELEMENT_TYPE['MILESTONE'] ? formatDate($task->date_end, 'Y-m-d') : formatDate($task->date_init, 'Y-m-d'),
                                'pEnd' => formatDate($task->date_end, 'Y-m-d'),
                                'pClass' => Task::GANTT_SEMAPHORE[Task::SEMAPHORE[$task->status]],
                                'pLink' => '',
                                'pMile' => $task->type === Task::ELEMENT_TYPE['MILESTONE'] ? 1 : 0,
                                'pRes' => $task->responsible->count() ? $task->responsible[0]->fullName() : '',
                                'pGroup' => 0,
                                'pParent' => "activity-{$activityProjectFiscalYear->id}",
                                'pOpen' => 1,
                                'pDepend' => '',
                                'pCaption' => '',
                                'encoded' => '',
                            ]);
                        });

                    }
                });
            }
        });

        return [
            'project' => $project,
            'semaphore' => $projectFiscalYear->getSemaphore(),
            'projectProgress' => $projectFiscalYear->getProgress(),
            'ganttStructure' => $ganttStructure->count() ? str_replace('\u0022', "\\\\\"", json_encode($ganttStructure, JSON_HEX_APOS | JSON_HEX_QUOT)) : null
        ];
    }

    /**
     * Carga información para generar el diagrama de gantt.
     *
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public function loadQuarterlyProgress(array $data)
    {

        $project = $this->projectRepository->find($data['project_id']);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        if (isset($data['date'])) {
            $fiscalYear = $this->fiscalYearRepository->findBy('year', DateTime::createFromFormat('!d-m-Y', $data['date'])->format('Y'));
        } else {
            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        }

        if (!$fiscalYear) {
            throw new Exception(trans('physical_progress.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->getProjectFiscalYear($project->id, $fiscalYear->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('physical_progress.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $progressStructure = $this->projectFiscalYearRepository->getQuarterlyProgressStructure($projectFiscalYear);

        $cumulative = [
            'q1' => 0,
            'q2' => 0,
            'q3' => 0,
            'q4' => 0,
        ];

        $progressStructure->each(function ($activity) use (&$cumulative) {
            $cumulative['q1'] += $activity['progress']['q1Cumulative'];
            $cumulative['q2'] += $activity['progress']['q2Cumulative'];
            $cumulative['q3'] += $activity['progress']['q3Cumulative'];
            $cumulative['q4'] += $activity['progress']['q4Cumulative'];
        });

        return [
            'project' => $project,
            'semaphore' => $projectFiscalYear->getSemaphore(),
            'projectProgress' => $projectFiscalYear->getProgress(),
            'progressStructure' => $progressStructure,
            'cumulative' => $cumulative
        ];
    }

    /**
     * Aprueba el avance físico
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function approve(int $id)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            throw  new Exception(trans('physical_progress.messages.exceptions.task_not_found'), 1000);
        }

        if (!count($task->files()->get())) {
            throw  new Exception(trans('physical_progress.messages.exceptions.task_not_file'), 1000);
        }

        $endDate = new DateTime($task->date_end);
        $dueDate = new DateTime($task->due_date);
        $data = [
            'approval_user_id' => currentUser()->id
        ];

        if ($dueDate > $endDate) {
            $data['status'] = Task::STATUS_COMPLETED_OUTOFTIME;
        } else {
            $data['status'] = Task::STATUS_COMPLETED_ONTIME;
        }

        $this->taskRepository->updateFromArray([
            'task' => $data
        ], $task);
    }

    /**
     * Rechaza el avance físico
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function reject(Request $request)
    {
        $task = $this->taskRepository->find($request->ids);

        if (!$task) {
            throw  new Exception(trans('physical_progress.messages.exceptions.task_not_found'), 1000);
        }

        $currentUser = currentUser();

        $this->taskRepository->updateFromArray([
            'task' => [
                'status' => Task::STATUS_REJECTED
            ],
            'rejectData' => [
                'observations' => $request->observations,
                'user_id' => $currentUser->id,
            ]
        ], $task);
    }

    /**
     * Obtiene datos para pantalla de rechazos
     *
     * @param Request $request
     *
     * @return array
     */
    public function rejectionsLog(Request $request)
    {
        $task = Task::find($request->id);

        return [
            'route' => route('data.rejections_log.physical.progress.project_tracking.execution', ['id' => $request->id]),
            'task' => $task
        ];

    }

    /**
     * Genera la estructura de datatable de rechazos
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function rejectionsLogData(Request $request)
    {
        $task = Task::find($request->id);

        $dataTable = DataTables::of($task->rejections)
            ->setRowId('id')
            ->addColumn('observations', function (Reject $entity) {
                return $entity->observations;
            })
            ->addColumn('user', function (Reject $entity) {
                return $entity->user->fullName();
            })
            ->addColumn('created_at', function (Reject $entity) {
                return $entity->created_at;
            })
            ->rawColumns(['observations', 'created_at'])
            ->make(true);

        return $dataTable;
    }
}
