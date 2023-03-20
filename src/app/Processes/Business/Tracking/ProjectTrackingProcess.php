<?php

namespace App\Processes\Business\Tracking;

use App\Models\Business\BudgetItem;
use App\Models\Business\Plan;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Models\Business\Task;
use App\Models\System\Role;
use App\Processes\Business\Execution\IndicatorProgressProcess;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Repositories\Repository\Business\ComponentRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ProjectTrackingProcess
 * @package App\Processes\Business\Tracking
 */
class ProjectTrackingProcess
{
    /**
     * @var ProjectFiscalYearRepository
     */
    protected $projectFiscalYearRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    /**
     * @var IndicatorProgressProcess
     */
    private $indicatorProgressProcess;

    /**
     * @var PlanElementProcess
     */
    private $planElementProcess;

    /**
     * @var ComponentRepository
     */
    private $componentRepository;

    /**
     * @var PlanIndicatorRepository
     */
    private $planIndicatorRepository;


    /**
     * Constructor de ProjectTrackingProcess.
     *
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectRepository $projectRepository
     * @param BudgetProjectTrackingRepository $budgetProjectTrackingRepository
     * @param IndicatorProgressProcess $indicatorProgressProcess
     * @param PlanElementProcess $planElementProcess
     * @param ComponentRepository $componentRepository
     * @param PlanIndicatorRepository $planIndicatorRepository
     */
    public function __construct(
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository,
        ProjectRepository $projectRepository,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository,
        IndicatorProgressProcess $indicatorProgressProcess,
        PlanElementProcess $planElementProcess,
        ComponentRepository $componentRepository,
        PlanIndicatorRepository $planIndicatorRepository
    ) {
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectRepository = $projectRepository;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
        $this->indicatorProgressProcess = $indicatorProgressProcess;
        $this->planElementProcess = $planElementProcess;
        $this->componentRepository = $componentRepository;
        $this->planIndicatorRepository = $planIndicatorRepository;
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
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'));
        }

        if ($user->hasRole(Role::PLANNER) || $user->hasRole(Role::ADMIN)) {
            $projectFiscalYears = $this->projectFiscalYearRepository->findAllTraceable($currentFiscalYear);
        } else {
            $departmentsFilter = $user->departments->map(function ($item, $key) {
                return $item->id;
            })->toArray();

            $projectFiscalYears = $this->projectFiscalYearRepository->findTraceableByUser($currentFiscalYear, $departmentsFilter);
        }

        if ($user->can('physical_budgetary_advancement.budget.progress.project_tracking.execution')) {
            $actions['line-chart'] = [
                'route' => 'physical_budgetary_advancement.budget.progress.project_tracking.execution',
                'tooltip' => trans('project_tracking.actions.physical_and_budget_progress'),
                'btn_class' => 'btn-success'
            ];
        }

        return DataTables::of($projectFiscalYears)
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
            ->filterColumn('projects.date_init', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(projects.date_init,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('projects.date_end', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(projects.date_end,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Obtiene los datos necesarios para cargar vista inicial de avances
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function progressIndex(int $id)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        return [
            'project' => $project = $projectFiscalYear->project,
            'projectId' => $id
        ];

    }

    /**
     * Obtiene los datos necesarios para cargar información de proyectos en el panel de control
     *
     * @throws Exception
     */
    public function projectsDashboard()
    {

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYears = $this->projectFiscalYearRepository->findByFiscalYearFilterByUser($currentFiscalYear, false);

        $projectCodes = [];
        $projectFiscalYears->each(function ($projectFiscalYear) use (&$projectCodes) {
            $projectCodes[] = $projectFiscalYear->project->getProgramSubProgramCode();
        });

        $projectItems = $this->budgetProjectTrackingRepository->findByProjectFiscalYearMonthly($projectFiscalYears->pluck('id')->toArray(), $currentFiscalYear);

        $budgetMonthly = ['accrued' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];

        self::processBudgetItems($projectItems, $budgetMonthly);

        return [
            'budgetMonthly' => $budgetMonthly,
        ];

    }

    /**
     * Procesa partidas presupuestarias
     *
     * @param Collection $projectBudgetItems
     * @param array $budgetMonthly
     */
    private function processBudgetItems(Collection &$projectBudgetItems, array &$budgetMonthly)
    {
        $projectBudgetItems->each(function ($item) use (&$budgetMonthly) {
            $budgetMonthly['accrued'][0] += $item->jan_accrued;
            $budgetMonthly['accrued'][1] += $item->feb_accrued;
            $budgetMonthly['accrued'][2] += $item->mar_accrued;
            $budgetMonthly['accrued'][3] += $item->apr_accrued;
            $budgetMonthly['accrued'][4] += $item->may_accrued;
            $budgetMonthly['accrued'][5] += $item->jun_accrued;
            $budgetMonthly['accrued'][6] += $item->jul_accrued;
            $budgetMonthly['accrued'][7] += $item->aug_accrued;
            $budgetMonthly['accrued'][8] += $item->sep_accrued;
            $budgetMonthly['accrued'][9] += $item->oct_accrued;
            $budgetMonthly['accrued'][10] += $item->nov_accrued;
            $budgetMonthly['accrued'][11] += $item->dec_accrued;
        });

    }

    /**
     * Obtiene información de proyectos
     *
     * @param int $projectFiscalYearId
     *
     * @return array
     * @throws Exception
     */
    public function filterBudgetProjects(int $projectFiscalYearId)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $filter = true;
        if (currentUser()->hasRole(Role::PLANNER) || currentUser()->hasRole(Role::ADMIN)) {
            $filter = false;
        }

        $projectFiscalYears = $this->projectFiscalYearRepository->findByFiscalYearFilterByUser($currentFiscalYear, $filter, $projectFiscalYearId);
        $projectBudgetItems = $this->budgetProjectTrackingRepository->findByProjectFiscalYearMonthly($projectFiscalYears->pluck('id')->toArray(), $currentFiscalYear);

        $budgetMonthly = [
            'encoded' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'accrued' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        ];

        self::processBudgetItems($projectBudgetItems, $budgetMonthly);

        return $budgetMonthly;
    }

    /**
     * Obtiene Información presupuestaria por un criterio
     *
     * @param string $criteria
     *
     * @return array
     * @throws Exception
     */
    public function filterBudgetCriteria(string $criteria)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $filter = true;
        if (currentUser()->hasRole(Role::PLANNER) || currentUser()->hasRole(Role::ADMIN)) {
            $filter = false;
        }

        $projectFiscalYears = $this->projectFiscalYearRepository->findByFiscalYearFilterByUser($currentFiscalYear, $filter);

        $projectBudgetItems = $this->budgetProjectTrackingRepository->findByProjectFiscalYearTotals($projectFiscalYears->pluck('id')->toArray(), $currentFiscalYear);

        $result = [];
        switch ($criteria) {
            case BudgetItem::CRITERIA[0]:
                $result = $projectBudgetItems->groupBy(function ($item) {
                    return $item->activityProjectFiscalYear->area->area;
                })->toArray();
                break;
            case BudgetItem::CRITERIA[1]:
                $result = $projectBudgetItems->groupBy(function ($item) {
                    return $item->activityProjectFiscalYear->component->project->responsibleUnit->name;
                })->toArray();
                break;
            case BudgetItem::CRITERIA[2]:
                $result = $projectBudgetItems->groupBy(function ($item) {
                    return $item->activityProjectFiscalYear->component->project->executingUnit->name;
                })->toArray();
        }
        return $result;
    }

    /**
     * Obtiene Información de avances físicos de proyectos
     *
     * @param int $projectFiscalYearId
     *
     * @return array
     * @throws Exception
     */
    public function filterPhysicalProjects(int $projectFiscalYearId)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $filter = true;
        if (currentUser()->hasRole(Role::PLANNER) || currentUser()->hasRole(Role::ADMIN)) {
            $filter = false;
        }

        $projectFiscalYears = $this->projectFiscalYearRepository->findByFiscalYearFilterByUser($currentFiscalYear, $filter, $projectFiscalYearId);

        $delayedTasks = collect([]);
        $tasksByStatus = [];

        $projectFiscalYears->each(function ($pfy) use (&$tasksByStatus, &$delayedTasks) {
            $pfy->activitiesProjectFiscalYear->each(function ($act) use (&$tasksByStatus, &$delayedTasks) {
                $taskGrouped = $act->tasks->groupBy(function ($task) {
                    return $task->status;
                });
                $tasksByStatus = array_merge_recursive($tasksByStatus, $taskGrouped->toArray());

                $delayedTasks = $delayedTasks->toBase()->merge($act->tasks->filter(function ($value, $key) {
                    return $value->status != Task::STATUS_COMPLETED_ONTIME && $value->status != Task::STATUS_COMPLETED_OUTOFTIME && Carbon::parse($value->date_end) < now();
                }));
            });
        });

        return [
            'delayedTasks' => $delayedTasks,
            'tasks' => $tasksByStatus
        ];
    }

    /**
     * Carga la información para mostrar el listado de proyectos en ejecución.
     *
     * @return mixed
     * @throws Exception
     */
    public function projectIndicatorsData()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('indicators.data.index.project_indicators.tracking')) {
            $actions['tachometer'] = [
                'route' => 'indicators.data.index.project_indicators.tracking',
                'tooltip' => trans('indicator_tracking.actions.indicators'),
                'btn_class' => 'btn-primary'
            ];

            $actions['tachometer']['params'] = [
                'year' => $this->fiscalYearRepository->findCurrentFiscalYear()->year
            ];
        }

        $dataTable = $this->projectsData($actions);

        return $dataTable;
    }

    /**
     * Carga la información para mostrar el listado de proyectos en ejecución con sus componentes.
     *
     * @return mixed
     * @throws Exception
     */
    public function projectComponentsData()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('components.data.index.project_components.tracking')) {
            $actions['cubes'] = [
                'route' => 'components.data.index.project_components.tracking',
                'tooltip' => trans('projects.actions.components'),
                'btn_class' => 'btn-primary'
            ];
        }

        $dataTable = $this->projectsData($actions);

        return $dataTable;
    }

    /**
     * Crea el datatable de los proyectos en progreso.
     *
     * @param array $actions
     *
     * @return mixed
     * @throws Exception
     */
    public function projectsData(array $actions)
    {
        $dataTable = DataTables::of($this->projectRepository->findByStatus(Project::STATUS_IN_PROGRESS))
            ->setRowId('id')
            ->editColumn('full_cup', function (Project $entity) {
                return $entity->full_cup;
            })
            ->editColumn('name', function (Project $entity) {
                return $entity->name;
            })
            ->editColumn('executing_unit', function (Project $entity) {
                if ($entity->executingUnit) {
                    return $entity->executingUnit->name;
                } else {
                    return trans('indicator_tracking.labels.no_available');
                }
            })
            ->editColumn('init_date', function (Project $entity) {
                return $entity->date_init;
            })
            ->editColumn('end_date', function (Project $entity) {
                return $entity->date_end;
            })
            ->addColumn('actions', function (Project $entity) use ($actions) {

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios para mostrar los indicadores del proyecto
     *
     * @param int $id
     * @param string $year
     *
     * @return array
     */
    public function projectIndicatorsShow(int $id, string $year)
    {
        $years = $this->indicatorProgressProcess->getYears(Plan::TYPE_PEI);
        $year = $year ?: (!empty($years) ? $years[0] : null);

        $project = $this->projectRepository->find($id);
        $indicators = $this->planElementProcess->chartIndicators($project, $year);
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        return [
            'currentFiscalYear' => $currentFiscalYear->year,
            'project' => $project,
            'years' => $years,
            'selectedYear' => $year,
            'indicators' => $indicators
        ];
    }

    /**
     * Obtiene los datos necesarios para mostrar los componentes del proyecto
     *
     * @param int $id
     *
     * @return array
     */
    public function projectComponentsShow(int $id)
    {
        $years = $this->indicatorProgressProcess->getYears(Plan::TYPE_PEI);
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear()->year;

        if ($currentFiscalYear) {
            $project = $this->projectRepository->find($id);
            $components = $project->components()->get();
        } else {
            $components = collect([]);
        }
        $thresholdsIndicators = $this->planElementProcess->thresholdsIndicators($components);

        return [
            'currentFiscalYear' => $currentFiscalYear,
            'elements' => $thresholdsIndicators[3]->keyBy('id'),
            'years' => $years,
            'indicators' => $thresholdsIndicators[0]
        ];
    }

    /**
     * Obtiene los datos necesarios para mostrar los indicadores del componente
     *
     * @param int $id
     * @param string $year
     *
     * @return array
     */
    public function projectComponentIndicators(int $id, string $year)
    {
        $component = $this->componentRepository->find($id);
        $indicators = $this->planElementProcess->chartIndicators($component, $year);

        return [
            'component' => $component,
            'indicators' => $indicators,
            'type' => 'components.tracking',
            'elementType' => 'component',
            'backRoute' => null
        ];
    }

    public function projectInidcatorDataExport()
    {
//        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $projects = $this->planIndicatorRepository->getAllIndicatorsProject();
        return [
            'projects' => $projects
        ];
    }
}