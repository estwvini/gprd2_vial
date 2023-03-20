<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Planning\BudgetPlanning;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\System\Role;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\BudgetPlanningRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\PublicPurchaseRepository;
use App\Repositories\Repository\Business\TaskRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\SFGPROV\ProformaRepository;
use App\Traits\FloatTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ProjectProcess
 * @package App\Processes\Business\Planning
 */
class ProjectProcess
{
    use FloatTrait;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    protected $projectFiscalYearRepository;

    /**
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    protected $activityProjectFiscalYearRepository;

    /**
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @var BudgetItemRepository
     */
    protected $budgetItemRepository;

    /**
     * @var PublicPurchaseRepository
     */
    protected $publicPurchaseRepository;

    /**
     * @var BudgetPlanningRepository
     */
    protected $budgetPlanningRepository;

    /**
     * @var ProformaRepository
     */
    protected $proformaRepository;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var OperationalGoalsRepository
     */
    private $operationalGoalsRepository;

    /**
     * @var PlanIndicatorRepository
     */
    private $indicatorRepository;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * Constructor de ProjectProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param DepartmentRepository $departmentRepository
     * @param UserRepository $userRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param ProjectRepository $projectRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param PublicPurchaseRepository $publicPurchaseRepository
     * @param BudgetPlanningRepository $budgetPlanningRepository
     * @param ProformaRepository $proformaRepository
     * @param BudgetProjectTrackingRepository $budgetProjectTrackingRepository
     * @param SettingRepository $settingRepository
     * @param TaskRepository $taskRepository
     * @param OperationalGoalsRepository $operationalGoalsRepository
     * @param PlanIndicatorRepository $indicatorRepository
     * @param MeasureUnitRepository $measureUnitRepository
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        DepartmentRepository $departmentRepository,
        UserRepository $userRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        ProjectRepository $projectRepository,
        BudgetItemRepository $budgetItemRepository,
        PublicPurchaseRepository $publicPurchaseRepository,
        BudgetPlanningRepository $budgetPlanningRepository,
        ProformaRepository $proformaRepository,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository,
        SettingRepository $settingRepository,
        TaskRepository $taskRepository,
        OperationalGoalsRepository $operationalGoalsRepository,
        PlanIndicatorRepository $indicatorRepository,
        MeasureUnitRepository $measureUnitRepository

    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->departmentRepository = $departmentRepository;
        $this->userRepository = $userRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->projectRepository = $projectRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->publicPurchaseRepository = $publicPurchaseRepository;
        $this->budgetPlanningRepository = $budgetPlanningRepository;
        $this->proformaRepository = $proformaRepository;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
        $this->settingRepository = $settingRepository;
        $this->taskRepository = $taskRepository;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
        $this->indicatorRepository = $indicatorRepository;
        $this->measureUnitRepository = $measureUnitRepository;
    }

    /**
     * Carga la información necesaria para renderizar en el index
     *
     * @return array
     */
    public function index()
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        return [
            'fiscalYear' => $fiscalYear->year
        ];
    }

    /**
     * Crear un datatable con información de proyectos.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_structure.messages.exceptions.fiscal_year_not_found'));
        }

        if ($user->can('structure.project.programmatic_structure.execution')) {
            $actions['sitemap'] = [
                'route' => 'structure.project.programmatic_structure.execution',
                'tooltip' => trans('project_structure.actions.restructure_project'),
                'btn_class' => 'btn-success'
            ];
        }

        $projectFiscalYears = $this->projectFiscalYearRepository->getAllProjectFiscalYears($currentFiscalYear->id, $user->hasRole(Role::LEADER) ? $user : null);

        $dataTable = DataTables::of($projectFiscalYears)
            ->setRowId('id')
            ->editColumn('full_cup', function (ProjectFiscalYear $entity) {
                return $entity->project->full_cup;
            })
            ->addColumn('name', function (ProjectFiscalYear $entity) {
                return $entity->project->name;
            })
            ->addColumn('responsibleUnit', function (ProjectFiscalYear $entity) {
                return $entity->project->responsibleUnit ? $entity->project->responsibleUnit->name : '';
            })
            ->addColumn('date_init', function (ProjectFiscalYear $entity) {
                return $entity->project->date_init;
            })
            ->addColumn('date_end', function (ProjectFiscalYear $entity) {
                return $entity->project->date_end;
            })
            ->addColumn('referential_budget', function (ProjectFiscalYear $entity) {
                return number_format($entity->referential_budget, 2);
            })
            ->editColumn('status', function (ProjectFiscalYear $entity) {
                return trans('projects.status.' . strtolower($entity->status));
            })
            ->addColumn('actions', function (ProjectFiscalYear $entity) use ($actions) {

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['responsibleUnit', 'referential_budget', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios para la pantalla base de la estructura del proyecto
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function structure(int $id)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        return [
            'project' => $projectFiscalYear->project,
            'projectFiscalYear' => $projectFiscalYear,
            'user' => currentUser()
        ];
    }

    /**
     * Verifica el estado del proyecto para su reestructuración
     *
     * @param int $id
     *
     * @return bool
     * @throws Exception
     */
    public function checkProjectStatus(int $id)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        if ($projectFiscalYear->status != ProjectFiscalYear::STATUS_IN_PROGRESS) {

            $hasPlannedBudgetItems = false;
            $projectFiscalYear->activitiesProjectFiscalYear->each(function ($activity) use (&$hasPlannedBudgetItems) {
                $activity->budgetItems->each(function ($budgetItem) use (&$hasPlannedBudgetItems) {
                    if ($budgetItem->amount > 0) {
                        $hasPlannedBudgetItems = true;
                        return false;
                    }
                });
            });

            return $hasPlannedBudgetItems;
        }

        return false;
    }

    /**
     * Actualiza a 0 los montos de todas las partidas presupuestarias y compras públicas del proyecto
     * Recalcula la ponderación de todas las tareas en base a presupuesto cero
     * Envía todas las partidas presupuestarias al sistema financiero para poder ser utilizadas en una reforma
     *
     * @param int $id
     *
     * @return bool
     */
    public function resetBudgetItems(int $id)
    {
        DB::transaction(function () use ($id) {
            $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

            if (!$projectFiscalYear) {
                throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
            }

            $activities = $this->activityProjectFiscalYearRepository->getActivitiesBudgetItems($projectFiscalYear->id);

            $budgetItems = collect([]);

            // Recalculate weight
            $activities->each(function ($activity) use (&$budgetItems) {
                // It it was planned
                if ($activity->duration && $activity->has_budget) {
                    $weight = (int)($activity->duration * $activity->relevance);

                    $this->activityProjectFiscalYearRepository->updateFromArray(['weight' => $weight], $activity);
                }

                $budgetItems = $budgetItems->merge($activity->budgetItems->map(function ($budgetItem) {
                    return $budgetItem;
                }));
            });

            $totalWeight = $activities->sum('weight');

            // Recalculate weight percentage
            $activities->each(function ($activity) use ($totalWeight) {
                if ($activity->duration) {
                    $weight_percentage = number_format(((int)$activity->weight * 100) / $totalWeight, 2, '.', '');

                    $this->activityProjectFiscalYearRepository->updateFromArray(['weight_percentage' => $weight_percentage], $activity);
                }
            });

            if ($budgetItems->count()) {
                $this->budgetItemRepository->resetAmount($budgetItems->pluck('id'));
                $this->publicPurchaseRepository->resetAmount($budgetItems->pluck('id'));
                $this->budgetPlanningRepository->removePlanning($budgetItems);
            }

        }, 5);

        return true;

    }

    /**
     * Inicia la ejecución de un proyecto
     * Envía todas las partidas presupuestarias del proyecto al sistema financiero para poder ser utilizadas en una reforma
     *
     * @param int $id
     *
     * @throws Throwable
     */
    public function start(int $id)
    {

        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $budgetItems = $this->budgetItemRepository->getItemsByProjectFiscalYear($id);

        $budgetItemProcess = resolve(BudgetItemProcess::class);
        $budgetItemsStructure = $budgetItemProcess->buildNewBudgetItemsStructure($budgetItems);

        if ($budgetItemsStructure->count()) {
            // Sync new income structure with financial system database
            $this->proformaRepository->syncStructure($budgetItemsStructure);

            // Change project status
            $this->projectFiscalYearRepository->changeState($projectFiscalYear, ProjectFiscalYear::STATUS_IN_PROGRESS);
        } else {
            throw new Exception(trans('projects.messages.exceptions.no_budget_items'), 1000);
        }
    }

    /**
     * Crear un datatable con información de proyectos.
     *
     * @return mixed
     * @throws Exception
     */
    public function dataBudgetary()
    {

        $user = currentUser();

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'));
        }

        $filter = true;
        if (currentUser()->hasRole(Role::PLANNER) || currentUser()->hasRole(Role::ADMIN)) {
            $filter = false;
        }

        $projectFiscalYears = $this->projectFiscalYearRepository->findAllTraceableByCurrentUser($currentFiscalYear, $filter);

        $actions = [];
        if ($user->can('edit.budgetary.reforms.reforms_reprogramming.execution')) {
            $actions['money'] = [
                'route' => 'edit.budgetary.reforms.reforms_reprogramming.execution',
                'tooltip' => trans('reforms.messages.actions.budgetary'),
                'btn_class' => 'btn-success'
            ];
        }

        $projectCodes = [];
        $projectFiscalYears->each(function ($projectFiscalYear) use (&$projectCodes) {
            $projectCodes[] = $projectFiscalYear->project->getProgramSubProgramCode();
        });

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $projectFiscalYears = $this->projectFiscalYearRepository->findProjectsWithReforms($sfgprov->company_code, $currentFiscalYear->year, $projectCodes,
            $projectFiscalYears);

        $dataTable = DataTables::of($projectFiscalYears)
            ->setRowId('id')
            ->editColumn('full_cup', function (ProjectFiscalYear $entity) {
                return $entity->project->full_cup;
            })
            ->addColumn('name', function (ProjectFiscalYear $entity) {
                return $entity->project->name;
            })
            ->addColumn('responsibleUnit', function (ProjectFiscalYear $entity) {
                return $entity->project->responsibleUnit ? $entity->project->responsibleUnit->name : '';
            })
            ->addColumn('leader', function (ProjectFiscalYear $entity) {
                return $entity->project->activeLeader() ? $entity->project->activeLeader()->fullName() : '';
            })
            ->addColumn('days', function (ProjectFiscalYear $entity) {
                $days = $entity->reform_date ? Carbon::parse($entity->reform_date)->diffInDays(now()) : 0;
                return "<span class='label label-warning'>{$days}</span>";
            })
            ->addColumn('date_init', function (ProjectFiscalYear $entity) {
                return $entity->project->date_init;
            })
            ->addColumn('date_end', function (ProjectFiscalYear $entity) {
                return $entity->project->date_end;
            })
            ->addColumn('referential_budget', function (ProjectFiscalYear $entity) {
                return number_format($entity->referential_budget, 2);
            })
            ->editColumn('status', function (ProjectFiscalYear $entity) {
                return trans('projects.status.' . strtolower($entity->status));
            })
            ->addColumn('actions', function (ProjectFiscalYear $entity) use ($actions, $user) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['responsibleUnit', 'referential_budget', 'actions', 'days'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene información para la reprogramación física y financiera
     *
     * @param int $projectId
     *
     * @return array
     * @throws Exception
     */
    public function reprogrammingIndexData(int $projectId)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($projectId);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $project = $projectFiscalYear->project;

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $activities = $this->activityProjectFiscalYearRepository->findByProjectFiscalYear($projectFiscalYear->id);

        $budget = self::dataBudget($activities, $projectFiscalYear);

        $operationalGoals = $this->operationalGoalsRepository->findByField('plan_element_id', $project->subprogram->parent->parent->id);

        return [$project, $budget, $fiscalYear, $projectFiscalYear, $operationalGoals];

    }

    /**
     * Obtiene información presupuestaria de actividades, partidas y compras públicas
     *
     * @param Collection $activities
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return array
     */
    public function dataBudget(Collection $activities, ProjectFiscalYear $projectFiscalYear)
    {
        $data = [];
        $index = 0;
        $projectBudgetItems = $this->budgetProjectTrackingRepository->findByProjectFiscalYearTotals([$projectFiscalYear->id], $projectFiscalYear->fiscalYear);

        $activities->each(function ($activity) use (&$data, &$index, $projectFiscalYear, $projectBudgetItems) {
            $budgetItems = $projectBudgetItems->where('activityProjectFiscalYear.id', $activity->id);

            if (!$budgetItems->count()) {
                return;
            }
            $parent = $index;

            $row = [
                'id' => $index,
                'primaryId' => $activity->id,
                'name' => $activity->code . ' - ' . $activity->name,
                'parent' => null,
                'indent' => 0,
                'editable' => false,
                'total_amount' => $budgetItems->sum('amount'), // Assigned
                'total_reform' => $budgetItems->sum('total_reform'), // Reform
                'total_encoded' => $budgetItems->sum('amount') + $budgetItems->sum('total_reform'), // Encoded
                'total_accrued' => $budgetItems->sum('total_accrued'), // Accrued
                'total_certificate' => $budgetItems->sum('total_certificate'), // Certificate
                'total_committed' => $budgetItems->sum('total_committed'), // Committed
                'total_not_accrued' => bcsub($budgetItems->sum('amount') + $budgetItems->sum('total_reform'), $budgetItems->sum('total_accrued'), 2)   // Not Accrued
            ];
            $monthsAct = BudgetPlanning::EMPTY_MONTH;
            $data[] = $row;
            $index++;
            $budgetItems->each(function ($item) use (&$data, &$index, $parent, &$monthsAct) {
                $row = [
                    'id' => $index,
                    'primaryId' => $item->id,
                    'name' => $item->budgetClassifier->full_code . ' - ' . $item->budgetClassifier->title,
                    'parent' => $parent,
                    'indent' => 1,
                    'editable' => true,
                    'total_amount' => $item->amount, // Assigned
                    'total_reform' => $item->total_reform, // Reform
                    'total_encoded' => $this->add($item->amount, $item->total_reform, 2), // Encoded
                    'total_accrued' => $item->total_accrued, // Accrued
                    'total_certificate' => $item->total_certificate, // Certificate
                    'total_committed' => $item->total_committed, // Committed
                    'total_not_accrued' => $this->substract($item->amount + $item->total_reform, $item->total_accrued, 2),// Not Accrued
                    'last_total_reform' => $item->total_reform
                ];

                $months = BudgetPlanning::EMPTY_MONTH;
                $item->budgetPlannings->each(function ($plan) use (&$months, &$monthsAct) {
                    $month = array_search($plan->month, BudgetPlanning::MONTH);
                    $months[$month] = $plan->assigned;
                    $monthsAct[$month] = $monthsAct[$month] + $plan->assigned;
                });
                $row = array_merge($row, $months);

                $data[] = $row;
                $index++;
            });
            $data[$parent] = array_merge($data[$parent], $monthsAct);
        });

        return $data;
    }

    /**
     * Verifica si se pueden editar las fechas de inicio y fin del proyecto
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return array
     */
    public function checkProjectDates(ProjectFiscalYear $projectFiscalYear)
    {
        $response = [
            'date_init' => true,
            'date_end' => true
        ];

        if ($projectFiscalYear->status != ProjectFiscalYear::STATUS_IN_PROGRESS) {
            $response['date_end'] = false;
            $response['date_init'] = false;
            return $response;
        }

        if (Carbon::parse($projectFiscalYear->project->date_init)->year < $projectFiscalYear->fiscalYear->year) {
            $response['date_init'] = false;
        } else {
            $task = $this->taskRepository->findByExecutedProject($projectFiscalYear->project->id);

            if ($task->count()) {
                $response['date_init'] = false;
            }
        }

        if (Carbon::parse($projectFiscalYear->project->date_end)->year > $projectFiscalYear->fiscalYear->year) {
            $response['date_end'] = false;
        }

        return $response;
    }

    /**
     * Actualizar fechas de proyecto
     *
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public function updateProjectDates(array $data)
    {
        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('projects.messages.success.updated')
            ]
        ];
        $projectFiscalYear = $this->projectFiscalYearRepository->find($data['projectFiscalYearId']);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $project = $projectFiscalYear->project;

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $data['project_id'] = $project->id;

        if ((strtotime($project->date_init) != strtotime($data['date_init'])) or (strtotime($project->date_end) != strtotime($data['date_end']))) {
            $this->projectRepository->updateProjectDates($data, $project, $projectFiscalYear);
        }

        return $response;
    }

    /**
     * Obtiene información para mostrar formulario de un componente
     *
     * @param int $indicatorId
     *
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function showIndicator(int $indicatorId)
    {
        $entity = $this->indicatorRepository->find($indicatorId);

        if (!$entity) {
            throw  new Exception(trans('indicators.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        if (!is_null($entity->measurement_frequency_per_year)) {
            $measuring_frequency = (date('Y', strtotime($entity->indicatorable->date_end)) - date('Y',
                        strtotime($entity->indicatorable->date_init))) * $entity->measurement_frequency_per_year;
        } else {
            $measuring_frequency = 0;
        }

        if (!is_null($entity->type)) {
            $type = PlanIndicator::types()[$entity->type];
        } else {
            $type = '';
        }

        if (!is_null($entity->goal_type)) {
            $goal_type = PlanIndicator::goalTypes()[$entity->goal_type];
        } else {
            $goal_type = '';
        }

        return [
            'measuringUnit' => isset($entity->measureUnit) ? $entity->measureUnit->name : '',
            'type' => $type,
            'goal_type' => $goal_type,
            'measuring_frequency' => $measuring_frequency,
            'entity' => $entity,
            'route' => $route,
            'yearPlanning' => date('Y', strtotime($entity->indicatorable->date_end)),
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'planId' => $entity->indicatorable->id,
            'planElementId' => $entity->indicatorable->id,
            'yearMeasurement' => date('Y'),
            'startYear' => date('Y', strtotime($entity->indicatorable->date_init)),
            'planType' => Plan::TYPE_PEI,
            'status' => $entity->indicatorable->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_PROJECT,
            'indicatorId' => $indicatorId
        ];
    }

    /**
     * Almacena un indicador completo
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function storeFullIndicator(Request $request)
    {
        $data = $request->all();
        $frequency = 1;

        $project = $this->projectRepository->find($data['projectId']);

        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = (date('Y', strtotime($project->date_end)) - date('Y', strtotime($project->date_init))) * $frequency;
        if ($frequency > 1) {
            $goalsCount += 1;
        }
        $indicator = $this->indicatorProcess->storeFullIndicator($request, $project, $goalsCount, date('Y', strtotime($project->date_init)));

        if (!$indicator) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        $project = $this->projectRepository->find($data['projectId']);

        if (!$project) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        return $project;
    }
}
