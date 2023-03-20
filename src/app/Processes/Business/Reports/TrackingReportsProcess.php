<?php

namespace App\Processes\Business\Reports;

use App\Models\Business\AdminActivity;
use App\Models\Business\BudgetItem;
use App\Models\Business\Component;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\PublicPurchase;
use App\Models\Business\Task;
use App\Processes\Business\Tracking\BudgetProjectTrackingProcess;
use App\Processes\Business\Tracking\ProjectPhysicalTrackingProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\AdminActivityRepository;
use App\Repositories\Repository\Business\ComponentRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\Reports\DashboardRepository;
use App\Repositories\Repository\Business\Reports\TrackingReportsRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nexmo\Call\Collection;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase TrackingReportsProcess
 *
 * @package App\Processes\Business\Reports
 */
class TrackingReportsProcess
{

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var TrackingReportsRepository
     */
    private $trackingReportsRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    /**
     * @var ComponentRepository
     */
    private $componentRepository;

    /**
     * @var AdminActivityRepository
     */
    private $adminActivityRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var DashboardRepository
     */
    private $dashboardRepository;

    /**
     * @var ProjectPhysicalTrackingProcess
     */
    private $projectPhysicalTrackingProcess;

    /**
     * @var BudgetProjectTrackingProcess
     */
    private $budgetProjectTrackingProcess;

    /**
     * Constructor de TrackingReportsProcess.
     *
     * @param TrackingReportsRepository $trackingReportsRepository
     * @param DepartmentRepository $departmentRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param SettingRepository $settingRepository
     * @param ProjectRepository $projectRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param BudgetProjectTrackingRepository $budgetProjectTrackingRepository
     * @param ComponentRepository $componentRepository
     * @param AdminActivityRepository $adminActivityRepository
     * @param UserRepository $userRepository
     * @param DashboardRepository $dashboardRepository
     * @param ProjectPhysicalTrackingProcess $projectPhysicalTrackingProcess
     * @param BudgetProjectTrackingProcess $budgetProjectTrackingProcess
     */
    public function __construct(
        TrackingReportsRepository $trackingReportsRepository,
        DepartmentRepository $departmentRepository,
        FiscalYearRepository $fiscalYearRepository,
        SettingRepository $settingRepository,
        ProjectRepository $projectRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository,
        ComponentRepository $componentRepository,
        AdminActivityRepository $adminActivityRepository,
        UserRepository $userRepository,
        DashboardRepository $dashboardRepository,
        ProjectPhysicalTrackingProcess $projectPhysicalTrackingProcess,
        BudgetProjectTrackingProcess $budgetProjectTrackingProcess
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->settingRepository = $settingRepository;
        $this->trackingReportsRepository = $trackingReportsRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
        $this->departmentRepository = $departmentRepository;
        $this->projectRepository = $projectRepository;
        $this->componentRepository = $componentRepository;
        $this->adminActivityRepository = $adminActivityRepository;
        $this->userRepository = $userRepository;
        $this->dashboardRepository = $dashboardRepository;
        $this->projectPhysicalTrackingProcess = $projectPhysicalTrackingProcess;
        $this->budgetProjectTrackingProcess = $budgetProjectTrackingProcess;
    }

    /**
     * Carga la información necesaria para mostrar la vista del reporte de poa.
     *
     * @return array
     * @throws Exception
     */
    public function poaReportIndex()
    {
        $executingUnits = $this->departmentRepository->all();

        if (!$executingUnits) {
            throw new Exception(trans('reports.exceptions.executing_units_not_found'));
        }

        $projects = $this->projectRepository->all();

        return [
            'executingUnits' => $executingUnits,
            'projects' => $projects
        ];
    }

    /**
     * Crear un datatable con la información del POA.
     *
     * @param array $data
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function poaReport(array $data)
    {

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('app.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }

        $data = $this->trackingReportsRepository->poaReport($fiscalYear, $data['filters']);
        $totalAmount = $data->sum('total_amount');
        $totalAssigned = $data->sum('assigned');
        $totalEncoded = $data->sum('assigned') + $data->sum('reform');
        $totalForCompromising = ($data->sum('assigned') + $data->sum('reform')) - $data->sum('committed');

        return DataTables::of($data)
            ->addColumn('area', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->area->code . ' - ' . $budgetItem->activityProjectFiscalYear->area->area;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->subprogram->parent->area->code . ' - ' . $budgetItem->operationalActivity->subprogram->parent->area->area;
                } else {
                    return '';
                }
            })
            ->addColumn('program', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->code . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->description;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->subprogram->parent->code . ' - ' .
                        $budgetItem->operationalActivity->subprogram->parent->name;
                } else {
                    return '';
                }
            })
            ->addColumn('subprogram', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->subprogram->code . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->subprogram->description;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->subprogram->code . ' - ' .
                        $budgetItem->operationalActivity->subprogram->name;
                } else {
                    return '';
                }
            })
            ->addColumn('project', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->cup . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->name;
                } else {
                    return BudgetItem::CODE_999;
                }
            })
            ->addColumn('activity', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->code . ' - ' . $budgetItem->activityProjectFiscalYear->name;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->code . ' - ' . $budgetItem->operationalActivity->name;
                } else {
                    return '';
                }
            })
            ->addColumn('executingUnit', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->executingUnit->code . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->executingUnit->name;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->executingUnit->code . ' - ' . $budgetItem->operationalActivity->executingUnit->name;
                } else {
                    return '';
                }
            })
            ->addColumn('institution', function (BudgetItem $budgetItem) {
                if ($budgetItem->institution) {
                    return $budgetItem->institution->code . ' - ' . $budgetItem->institution->name;
                }
                return '';
            })
            ->addColumn('nature', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->budgetClassifier->full_code)[0];
            })
            ->addColumn('group', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->budgetClassifier->full_code)[1];
            })
            ->addColumn('subgroup', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->budgetClassifier->full_code)[2];
            })
            ->addColumn('item', function (BudgetItem $budgetItem) {
                return $budgetItem->budgetClassifier->code . ' - ' . $budgetItem->budgetClassifier->title;
            })
            ->addColumn('orientation', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->spendingGuide->full_code)[0];
            })
            ->addColumn('direction', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->spendingGuide->full_code)[1];
            })
            ->addColumn('category', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->spendingGuide->full_code)[2];
            })
            ->addColumn('subCategory', function (BudgetItem $budgetItem) {
                return $budgetItem->spendingGuide->code . ' - ' . $budgetItem->spendingGuide->description;
            })
            ->addColumn('province', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->geographicLocation->getFullCode())[0];
            })
            ->addColumn('canton', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->geographicLocation->getFullCode())[1];
            })
            ->addColumn('parish', function (BudgetItem $budgetItem) {
                return $budgetItem->geographicLocation->code . ' - ' . $budgetItem->geographicLocation->description;
            })
            ->addColumn('source', function (BudgetItem $budgetItem) {
                return $budgetItem->source->code . ' - ' . $budgetItem->source->description;
            })
            ->addColumn('competence', function (BudgetItem $budgetItem) {
                if ($budgetItem->competence) {
                    return $budgetItem->competence->code . ' - ' . $budgetItem->competence->name;
                }
                return '';
            })
            ->addColumn('description', function (BudgetItem $budgetItem) {
                return $budgetItem->description ?? '';
            })
            ->editColumn('total_amount', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->total_amount, 2);
            })
            ->addColumn('assigned', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->assigned, 2);
            })
            ->addColumn('encoded', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->assigned + $budgetItem->reform, 2);
            })
            ->addColumn('for_compromising', function (BudgetItem $budgetItem) {
                return number_format(($budgetItem->assigned + $budgetItem->reform) - $budgetItem->committed, 2);
            })
            ->editColumn('jan', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jan, 2);
            })
            ->editColumn('feb', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->feb, 2);
            })
            ->editColumn('mar', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->mar, 2);
            })
            ->editColumn('t1', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jan + $budgetItem->feb + $budgetItem->mar, 2);
            })
            ->editColumn('apr', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->apr, 2);
            })
            ->editColumn('may', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->may, 2);
            })
            ->editColumn('jun', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jun, 2);
            })
            ->editColumn('t2', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->apr + $budgetItem->may + $budgetItem->jun, 2);
            })
            ->editColumn('jul', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jul, 2);
            })
            ->editColumn('aug', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->aug, 2);
            })
            ->editColumn('sep', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->sep, 2);
            })
            ->editColumn('t3', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jul + $budgetItem->aug + $budgetItem->sep, 2);
            })
            ->editColumn('oct', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->oct, 2);
            })
            ->editColumn('nov', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->nov, 2);
            })
            ->editColumn('dec', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->dec, 2);
            })
            ->editColumn('t4', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->oct + $budgetItem->nov + $budgetItem->dec, 2);
            })
            ->with('totalAmount', number_format($totalAmount, 2))
            ->with('totalEncoded', number_format($totalEncoded, 2))
            ->with('totalAssigned', number_format($totalAssigned, 2))
            ->with('totalForCompromising', number_format($totalForCompromising, 2))
            ->make(true);
    }

    /**
     * Buscar proyectos por unidad responsable
     *
     * @param int $executingUnitId
     *
     * @return mixed
     * @throws Exception
     */
    public function projectsByExecutingUnit(int $executingUnitId)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('reforms.messages.exceptions.fiscal_year_not_found'));
        }

        return $this->projectFiscalYearRepository->findByExecutingUnit($currentFiscalYear, $executingUnitId)->get();
    }

    /**
     * Obtiene la información necesaria para el exportable en pdf del poa.
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function poaReportExport(Request $request)
    {
        $rows = self::poaReport($request->all())->getData();
        $date = date('d-m-Y');

        return [
            'rows' => $rows->data,
            'date' => $date,
            'totalAmount' => !isset($rows->totalAmount) ? 0 : $rows->totalAmount
        ];
    }

    /**
     * Buscar información para informe ejecutivo de proyectos
     *
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public function executionProjectsIndex(array $data)
    {

        $date = $data['date'] ?? date('d-m-Y');
        $fiscalYear = $this->fiscalYearRepository->findBy('year', DateTime::createFromFormat('!d-m-Y', $date)->format('Y'));

        if (!$fiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYears = $this->trackingReportsRepository->findByFiscalYear($fiscalYear, $data['responsible_unit_id']);

        $projectCodes = [];
        $projectFiscalYears->each(function ($projectFiscalYear) use (&$projectCodes) {
            $projectCodes[] = $projectFiscalYear->project->getProgramSubProgramCode();
        });

        $projectFiscalYears = $this->budgetProjectTrackingRepository->getProjectBudgetProgress($projectFiscalYears, $projectCodes, $fiscalYear->year);

        $projectFiscalYears->each(function ($pfy) {
            $executedMilestone = collect([]);
            $delayedMilestone = collect([]);
            $nextMilestone = collect([]);
            $pfy->activitiesProjectFiscalYear->each(function ($act) use (&$executedMilestone, &$delayedMilestone, &$nextMilestone) {
                $delayedMilestone = $delayedMilestone->toBase()->merge($act->tasks->filter(function ($value, $key) {
                    return $value->type == Task::ELEMENT_TYPE['MILESTONE'] && $value->status != Task::STATUS_COMPLETED_ONTIME && $value->status != Task::STATUS_COMPLETED_OUTOFTIME
                        && Carbon::parse($value->date_end) < now();
                }));

                $executedMilestone = $executedMilestone->toBase()->merge($act->tasks->filter(function ($value, $key) {
                    return $value->type == Task::ELEMENT_TYPE['MILESTONE'] && ($value->status == Task::STATUS_COMPLETED_ONTIME
                            || $value->status == Task::STATUS_COMPLETED_OUTOFTIME);
                }));

                $nextMilestone = $nextMilestone->toBase()->merge($act->tasks->filter(function ($value, $key) {
                    return $value->type == Task::ELEMENT_TYPE['MILESTONE'] && ($value->status != Task::STATUS_COMPLETED_ONTIME ||
                            $value->status != Task::STATUS_COMPLETED_OUTOFTIME)
                        && Carbon::parse($value->date_end) > now() && Carbon::parse($value->date_end) < now()->addMonth(3);
                }));

            });

            $pfy->setAttribute('physical_progress', $pfy->getProgress());
            $pfy->setAttribute('physical_semaphore', $pfy->getSemaphore());
            $pfy->setAttribute('budget_semaphore', $pfy->getBudgetSemaphore());
            $pfy->setAttribute('delayedMilestones', $delayedMilestone);
            $pfy->setAttribute('executedMilestone', $executedMilestone);
            $pfy->setAttribute('nextMilestone', $nextMilestone);
            $pfy->setAttribute('encoded', $pfy->assigned + $pfy->reforms);
            $pfy->setAttribute('percent', $pfy->encoded ? number_format(($pfy->accrued * 100 / $pfy->encoded), 2) : 0.00);
        });

        return [$projectFiscalYears, $fiscalYear->year];
    }

    /**
     * Retorna información para reporte de avance de la planificación de proyectos
     *
     * @return array
     */
    public function planningExecutionProjectsIndex()
    {
        return ['executingUnits' => $this->departmentRepository->findEnabled()];
    }

    /**
     * Retorna información para exportar reporte de avance de la planificación de proyectos
     *
     * @param array $data
     *
     * @return array[]
     * @throws Exception
     */
    public function planningExecutionProjectsIndexExport(array $data)
    {

        $date = $data['date'] ?? date('d-m-Y');
        $fiscalYear = $this->fiscalYearRepository->findBy('year', DateTime::createFromFormat('!d-m-Y', $date)->format('Y'));

        $projects = $this->projectFiscalYearRepository->findByExecutingUnit($fiscalYear, $data['responsible_unit_id'])->get();

        $data = [];

        $projects->each(function ($projectFiscalYear) use (&$data, $date) {
            $budgetData = $this->budgetProjectTrackingProcess->data($projectFiscalYear->id)->getData();
            $data[] = array_merge(
                [
                    'projectFiscalYear' => $projectFiscalYear
                ],
                $this->projectPhysicalTrackingProcess->loadQuarterlyProgress(['project_id' => $projectFiscalYear->project->id, 'date' => $date]),
                [
                    'budgetData' => $budgetData->data,
                    'budgetTotals' => $budgetData->totals
                ]
            );
        });

        return $data;
    }

    /**
     * Crear un datatable con la información del reporte de arrastre de proyectos
     *
     * @param string $thousands_sep
     *
     * @return mixed
     * @throws Exception
     */
    public function ongoingProjectDataTable(string $thousands_sep = ',')
    {

        $dataProjects = $this->projectFiscalYearRepository->findOngoingProjects();

        $byYears = $dataProjects->groupBy('year');

        $projectFiscalYears = collect([]);
        foreach ($byYears as $year => $projects) {
            $projectCodes = [];
            $projects->each(function ($projectFiscalYear) use (&$projectCodes) {
                $projectCodes[] = $projectFiscalYear->project->getProgramSubProgramCode();
            });
            $projectFiscalYears = $projectFiscalYears->merge($this->budgetProjectTrackingRepository->getProjectBudgetProgress($projects, $projectCodes, $year));
        }

        $dataTable = DataTables::of($projectFiscalYears->sortBy('project.id'))
            ->setRowId('id')
            ->addColumn('name', function (ProjectFiscalYear $entity) {
                return $entity->project->name;
            })
            ->addColumn('year', function (ProjectFiscalYear $entity) {
                return $entity->fiscalYear->year;
            })
            ->addColumn('executed', function (ProjectFiscalYear $entity) use ($thousands_sep) {
                return number_format($entity->accrued, 2, '.', $thousands_sep);
            })
            ->addColumn('not_executed', function (ProjectFiscalYear $entity) use ($thousands_sep) {
                return number_format(($entity->assigned + $entity->reforms) - $entity->accrued, 2, '.', $thousands_sep);
            })
            ->addColumn('percent', function (ProjectFiscalYear $entity) use ($thousands_sep) {
                return ($entity->assigned + $entity->reforms) > 0 ? number_format(($entity->accrued * 100 / ($entity->assigned + $entity->reforms)), 2, '.', $thousands_sep) : 0.00;
            })
            ->make(true);
        return $dataTable;
    }

    /**
     * Carga la información necesaria para mostrar la vista del reporte Comparativo entre planificado y devengado.
     *
     * @return array
     * @throws Exception
     */
    public function planningAccruedIndex()
    {
        $executingUnits = $this->departmentRepository->all();

        if (!$executingUnits) {
            throw new Exception(trans('reports.exceptions.executing_units_not_found'));
        }

        return [
            'executingUnits' => $executingUnits,
            'gad' => $this->settingRepository->findByKey('gad')->value['province'],
            'date' => $date = date('d-m-Y')
        ];
    }

    /**
     * Carga la información necesaria para mostrar la tabla del reporte Comparativo entre planificado y devengado.
     *
     * @param int $executingUnitID
     *
     * @return array
     * @throws Exception
     */
    public function projectActivityData(int $executingUnitID)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('app.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }

        $executingUnit = $this->departmentRepository->find($executingUnitID);
        $executingUnitId = 0;
        if ($executingUnit) {
            $executingUnitId = $executingUnit->id;
        }

        $projectFiscalYears = $this->trackingReportsRepository->projectsInProgressPlanningAccruedData($currentFiscalYear->id, $executingUnitId);

        $projectCodes = [];
        $projectFiscalYears->each(function ($projectFiscalYear) use (&$projectCodes) {
            $projectCodes[] = $projectFiscalYear->project->getProgramSubProgramCode();
        });

        $projectFiscalYears = $this->trackingReportsRepository->getProjectBudgetProgress($projectFiscalYears, $projectCodes, $currentFiscalYear->year);

        return [
            'data' => $projectFiscalYears,
            'executingUnit' => $executingUnit ? ($executingUnit->code . '-' . $executingUnit->name) : trans('reports.planning_accrued.all_units')
        ];
    }

    /**
     * Retorna las tareas hitos
     *
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public function taskMilestoneData(array $filter)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        return DataTables::of($this->trackingReportsRepository->findByFiscalYearFilterByUser($currentFiscalYear, $filter)->get())
            ->setRowId('id')
            ->addColumn('reportStatus', function (Task $entity) {
                return trans('reports.task_milestone.' . strtolower($entity->status));
            })
            ->editColumn('status', function (Task $entity) {
                switch ($entity->status) {
                    case($entity::STATUS_TO_REVIEW):
                        return '<span class="label label-warning">' . trans('reports.task_milestone.' . strtolower($entity::STATUS_TO_REVIEW)) . '</span>';
                        break;
                    case($entity::STATUS_PENDING):
                        return '<span class="label label-primary">' . trans('reports.task_milestone.' . strtolower($entity::STATUS_PENDING)) . '</span>';
                        break;
                    case($entity::STATUS_REJECTED):
                        return '<span class="label label-danger">' . trans('reports.task_milestone.' . strtolower($entity::STATUS_REJECTED)) . '</span>';
                        break;
                    case($entity::STATUS_DELAYED):
                        return '<span class="label label-danger">' . trans('reports.task_milestone.' . strtolower($entity::STATUS_DELAYED)) . '</span>';
                        break;
                }
            })
            ->editColumn('responsible', function (Task $entity) {
                return $entity->responsible()->first()->fullName();
            })
            ->addColumn('days_overdue', function (Task $entity) {
                if (Carbon::parse($entity->date_end) < now()) {
                    return Carbon::parse($entity->date_end)->diffInDays(now());
                } else {
                    return 0;
                }
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    /**
     * Retorna los componentes con sus proyestos
     *
     * @return mixed
     * @throws Exception
     */
    public function riskMitigationPlanData()
    {
        return DataTables::of($this->componentRepository->getAllWithProject()->get())
            ->setRowId('id')
            ->addColumn('responsibleUnit', function (Component $entity) {
                return $entity->project->responsibleUnit ? $entity->project->responsibleUnit->name : '';
            })
            ->addColumn('projectLeader', function (Component $entity) {
                return $entity->project->activeLeader()->fullName();
            })
            ->make(true);
    }

    /**
     * Retorna los presupuestos participativos
     *
     * @return mixed
     * @throws Exception
     */
    public function participatoryBudgetData()
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('app.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }
        return DataTables::of($this->trackingReportsRepository->participatoryBudgetData($fiscalYear))->setRowId('id')
            ->make(true);

    }

    /**
     * Retorna las actividades administrativas
     *
     * @param array $filters
     *
     * @return mixed
     * @throws Exception
     */
    public function adminActivitiesData(array $filters)
    {
//        $filters['date_end'] = $dateEnd = DateTime::createFromFormat('d-m-Y', $filters['date_end']);
        return DataTables::of($this->adminActivityRepository->findAllByFilters($filters))
            ->setRowId('id')
            ->editColumn('assigned_user_id', function (AdminActivity $entity) {
                return $entity->assigned ? $entity->assigned->fullName() : '';
            })
            ->editColumn('responsible_unit_id', function (AdminActivity $entity) {
                return $entity->responsibleUnit ? $entity->responsibleUnit->name : '';
            })
            ->editColumn('name', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.name', ['entity' => $entity]);
            })
            ->editColumn('activity_type_id', function (AdminActivity $entity) {
                return $entity->activityType ? $entity->activityType->name : '';
            })
            ->editColumn('status', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.status', ['entity' => $entity]);
            })
            ->editColumn('qualification', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.qualification', ['entity' => $entity]);
            })
            ->editColumn('comments', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.comments_index', ['entity' => $entity]);
            })
            ->editColumn('getCheckList', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.checkList', ['entity' => $entity]);
            })
            ->editColumn('getPercentageCheckList', function (AdminActivity $entity) {
                return $entity->getPercentageCheckList() > 0 ? $entity->getPercentageCheckList() : '0';
            })
            ->editColumn('priority', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.priority', ['entity' => $entity]);
            })
            ->editColumn('date_init', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.date_init', ['entity' => $entity]);
            })
            ->editColumn('date_end', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.date_end', ['entity' => $entity]);
            })
            ->rawColumns(['name', 'status', 'priority', 'date_init', 'date_end', 'photo', 'qualification', 'comments', 'getCheckList'])
            ->make(true);
    }

    /**
     * Retorna información para reporte de actividades administrativas
     *
     * @return array
     */
    public function adminActivitiesIndex()
    {
        $users = $this->userRepository->findVisible();
        $responsibleUnits = $this->departmentRepository->findEnabled();
        $years = $this->fiscalYearRepository->all();
        $currentYearId = $this->fiscalYearRepository->findCurrentFiscalYear()->id;

        return [
            'users' => $users,
            'responsibleUnits' => $responsibleUnits,
            'years' => $years,
            'currentYearId' => $currentYearId
        ];
    }

    /**
     * Obtiene la información necesaria para exportar el reporte de actividades administrativas
     *
     * @param array $filters
     *
     * @return array
     * @throws Exception
     */
    public function agreementForeResultsExport(array $filters)
    {

        $rows = self::adminActivitiesData($filters)->getData();
        $date = date('d-m-Y');
        $year = $this->fiscalYearRepository->find($filters['fiscal_year_id'])->year;
        $responsibleUnit = isset($filters['responsible_unit_id']) ? $this->departmentRepository->find($filters['responsible_unit_id'])->name : trans('app.labels.all');
        $assigned = isset($filters['assigned_user_id']) ? $this->userRepository->find($filters['assigned_user_id'])->fullName() : trans('app.labels.all');
        $activityType = isset($filters['activity_type_id']) ? $this->adminActivityRepository->find($filters['activity_type_id'])->name : trans('app.labels.all');
        $status = isset($filters['status']) ? trans('admin_activities.labels.status_' . $filters['status']) : trans('app.labels.all');
        $priority = isset($filters['priority']) ? trans('admin_activities.labels.priority_' . $filters['priority']) : trans('app.labels.all');
        $gadInfo = $this->settingRepository->findByKey('gad')->value;

        return [
            'rows' => $rows->data,
            'date' => $date,
            'gad' => $gadInfo['province'],
            'year' => $year,
            'responsibleUnit' => $responsibleUnit,
            'assigned' => $assigned,
            'activityType' => $activityType,
            'status' => $status,
            'priority' => $priority
        ];
    }

    /**
     * Obtiene información necesaria para los filtros del reporte pac
     *
     * @return array
     * @throws Exception
     */
    public function pacReport()
    {
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;
        return compact('years', 'currentYear');
    }

    /**
     * Crear un datatable con la información del PAC.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function pacReportData(Request $request)
    {
        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->find($data['fiscalYearId']);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $pacReport = $this->trackingReportsRepository->pacReport($fiscalYear->id);
        $totalAmount = $pacReport->sum('amount');

        return DataTables::of($pacReport)
            ->addColumn('fiscalYear', function () use ($fiscalYear) {
                return $fiscalYear->year;
            })
            ->addColumn('institution', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->institution) {
                    return $purchase->budgetItem->institution->code;
                } else {
                    return '';
                }
            })
            ->addColumn('responsibleUnit', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->responsibleUnit->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->responsibleUnit->code;
                } else {
                    return '';
                }
            })
            ->addColumn('executingUnit', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->executingUnit->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->executingUnit->code;
                } else {
                    return '';
                }
            })
            ->addColumn('program', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->subprogram->parent->code;
                } else {
                    return '';
                }
            })
            ->addColumn('subprogram', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->subprogram->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->subprogram->code;
                } else {
                    return '';
                }
            })
            ->addColumn('project', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->cup;
                } else {
                    return BudgetItem::CODE_999;
                }
            })
            ->addColumn('activity', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->code;
                } else {
                    return '';
                }
            })
            ->addColumn('geographic', function (PublicPurchase $purchase) {
                return $purchase->budgetItem->geographicLocation->getFullCode();
            })
            ->addColumn('item', function (PublicPurchase $purchase) {
                return $purchase->budgetItem->budgetClassifier->full_code;
            })
            ->addColumn('source', function (PublicPurchase $purchase) {
                return $purchase->budgetItem->source->code;
            })
            ->addColumn('projectName', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->name;
                } else {
                    return '';
                }
            })
            ->addColumn('cpc', function (PublicPurchase $purchase) {
                return $purchase->cpcClassifier->code;
            })
            ->addColumn('cpcDescription', function (PublicPurchase $purchase) {
                return $purchase->cpcClassifier->description;
            })
            ->editColumn('international_funds', function (PublicPurchase $purchase) {
                return $purchase->is_international_fund ? PublicPurchase::YES : PublicPurchase::NO;
            })
            ->editColumn('measure_unit', function (PublicPurchase $purchase) {
                return $purchase->measureUnit->name;
            })
            ->editColumn('amount_no_vat', function (PublicPurchase $purchase) {
                return number_format($purchase->amount_no_vat, 2, ',', '.');
            })
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);
    }

    /**
     * Obtiene los datos necesarios para el pac
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function pacExportXls(int $fiscalYearId)
    {
        $fiscalYear = $this->fiscalYearRepository->find($fiscalYearId);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $reportData = $this->trackingReportsRepository->pacReport($fiscalYear->id);

        return [
            'year' => $fiscalYear->year,
            'rows' => $reportData,
            'provinceCode' => $this->settingRepository->findByKey('gad')->value['code']
        ];
    }

    /**
     * Obtiene la información necesaria para mostrar el reporte de actividades administrativas por direcciones
     *
     * @return array
     */
    public function adminActivitiesResponsibleUnit()
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $date = date('d-m-Y');

        $priorities = $this->adminActivityRepository->findGroupByPriority($fiscalYear, true, currentUser()->id);
        $num = 0;
        $den = 0;

        $priorities->each(function ($item) use (&$num, &$den) {
            switch ($item->priority) {
                case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_URGENT):
                    $num += 100 * $item->completed;
                    $den += 100 * ($item->draft + $item->completed + $item->in_progress);
                    break;
                case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_IMPORTANT):
                    $num += 75 * $item->completed;
                    $den += 75 * ($item->draft + $item->completed + $item->in_progress);
                    break;
                case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_MEDIUM):
                    $num += 50 * $item->completed;
                    $den += 50 * ($item->draft + $item->completed + $item->in_progress);
                    break;
                case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_LOW):
                    $num += 25 * $item->completed;
                    $den += 25 * ($item->draft + $item->completed + $item->in_progress);
            }
        });

        return [
            'responsibleUnits' => $this->adminActivityRepository->findGroupByResponsibleUnit($fiscalYear, true, currentUser()->id, false),
            'date' => $date,
            'gad' => $gadInfo['province'],
            'total_percent' => $den != 0 ? ($num * 100 / $den) : 0
        ];
    }

    /**
     * Obtiene información para reporte de avance ejecución física y presupuestaria de proyectos
     *
     * @param array $data
     *
     * @return array
     */
    public function progressInvestmentProject(array $data)
    {
        $date = $data['date'] ?? date('d-m-Y');
        $fiscalYear = $this->fiscalYearRepository->findBy('year', DateTime::createFromFormat('!d-m-Y', $date)->format('Y'));
        $gadInfo = $this->settingRepository->findByKey('gad')->value;

        $physical_progress = 0;
        $budget_progress = 0;
        $encoded_total = 0;
        $projectFiscalYears = [];

        if ($fiscalYear) {
            $projectFiscalYearsBudget = collect([]);
            if (api_available()) {
                $projectFiscalYearsBudget = $this->trackingReportsRepository->progressExecutionProgress($fiscalYear->year,
                    DateTime::createFromFormat('!d-m-Y', $date)->format('Y-m-d'), 4, 9, 4);
            }

            $projectFiscalYears = $this->trackingReportsRepository->getExecutionProjects($fiscalYear->id, $date)->map(function ($item) use (
                $projectFiscalYearsBudget,
                &$budget_progress,
                &$physical_progress,
                &$encoded_total
            ) {
                $project = $projectFiscalYearsBudget->firstWhere('codigo', $item->project->getProgramSubProgramCode());

                if ($project) {
                    $item->setAttribute('encoded', $project->codificado);
                    $item->setAttribute('budget_percent', $project->porciento_ejecucion);
                    $budget_progress += $project->porciento_ejecucion;
                    $encoded_total += $project->codificado;
                } else {
                    $item->setAttribute('encoded', 0);
                    $item->setAttribute('budget_percent', 0);
                }

                $physical_progress += $item->getProgress();

                return $item;
            });
        }

        return [
            'projectFiscalYears' => $projectFiscalYears,
            'date' => $date,
            'gad' => $gadInfo['province'],
            'physical_progress' => count($projectFiscalYears) ? ($physical_progress / count($projectFiscalYears)) : 0,
            'budget_progress' => count($projectFiscalYears) ? ($budget_progress / count($projectFiscalYears)) : 0,
            'encoded_total' => $encoded_total,
            'date_filter' => $date
        ];
    }

    /**
     * Obtiene la información necesaria para mostrar el reporte de actividades administrativas y presupuesto por direcciones
     *
     * @param bool $all
     * @param array $data
     *
     * @return array
     */
    public function adminActivitiesBudgetResponsibleUnit(bool $all, array $data)
    {
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $date = $data['date'] ?? date('d-m-Y');
        $fiscalYear = $this->fiscalYearRepository->findBy('year', DateTime::createFromFormat('!d-m-Y', $date)->format('Y'));
        $units = [];

        if ($fiscalYear) {
            $budgetUnits = collect([]);
            if (api_available()) {
                $budgetUnits = $this->dashboardRepository->budgetByCategory($fiscalYear->year,
                    DateTime::createFromFormat('!d-m-Y', $date)->format('Y-m-d'), 14, 3, 5);
            }

            $projectFiscalYears = $this->trackingReportsRepository->getExecutionProjects($fiscalYear->id, $date);

            $units = $this->adminActivityRepository->findGroupByResponsibleUnit($fiscalYear, true, currentUser()->id, $all)->map(function ($item) use (
                $fiscalYear,
                $budgetUnits,
                $projectFiscalYears
            ) {
                $priorities = $this->adminActivityRepository->findGroupByPriorityAndResponsibleUnit($fiscalYear, true, currentUser()->id, $item->id);
                $num = 0;
                $den = 0;

                $priorities->each(function ($item) use (&$num, &$den) {
                    switch ($item->priority) {
                        case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_URGENT):
                            $num += 100 * $item->completed;
                            $den += 100 * ($item->draft + $item->completed + $item->in_progress);
                            break;
                        case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_IMPORTANT):
                            $num += 75 * $item->completed;
                            $den += 75 * ($item->draft + $item->completed + $item->in_progress);
                            break;
                        case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_MEDIUM):
                            $num += 50 * $item->completed;
                            $den += 50 * ($item->draft + $item->completed + $item->in_progress);
                            break;
                        case trans('admin_activities.labels.priority_' . AdminActivity::PRIORITY_LOW):
                            $num += 25 * $item->completed;
                            $den += 25 * ($item->draft + $item->completed + $item->in_progress);
                    }
                });

                $item->setAttribute('physical_percent', $den != 0 ? ($num * 100 / $den) : 0);

                $filteredProjects = $projectFiscalYears->filter(function ($proj) use ($item) {
                    return $item->code == $proj->executingUnitCode;
                });

                $sumPercent = $filteredProjects->reduce(function ($percent, $item) {
                    return $percent + $item->getProgress();
                });

                $item->setAttribute('physical_invest_percent', count($filteredProjects) ? $sumPercent / count($filteredProjects) : 0);

                $budget = $budgetUnits->firstWhere('codigo', $item->code);

                if ($budget) {
                    $item->setAttribute('encoded', $budget->codificado);
                    $item->setAttribute('budget_percent', $budget->porciento_ejecucion);
                } else {
                    $item->setAttribute('encoded', 0);
                    $item->setAttribute('budget_percent', 0);
                }

                return $item;
            });
        }


        return [
            'responsibleUnits' => $units,
            'date' => $date,
            'gad' => $gadInfo['province'],
            'date_filter' => $date
        ];
    }

    /**
     * Obtiene la información necesaria para mostrar el reporte Ejectivo Avance de Proyectos de Inversión
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function executiveProgressProject(array $data)
    {
        $indexGroup = 0;
        $indexProject = 1;
        $last = '';
        $projects = $this->progressInvestmentProject($data)['projectFiscalYears']->each(function ($item, $key) use (&$indexGroup, &$indexProject, &$last) {
            if ($item->executingUnit != $last) {
                $indexGroup++;
                $indexProject = 1;
                $last = $item->executingUnit;
            }

            $item->executingUnit = $indexGroup . '. ' . $item->executingUnit;
            $item->project_name = $indexGroup . '.' . $indexProject . '. ' . $item->project_name;
            $indexProject++;
            return $item;
        });

        return DataTables::of($projects)
            ->setRowId('id')
            ->addColumn('physical_percent', function (ProjectFiscalYear $entity) {
                return number_format($entity->getProgress(), 2);
            })
            ->editColumn('budget_percent', function (ProjectFiscalYear $entity) {
                return number_format($entity->budget_percent, 2);
            })
            ->make(true);
    }

    /**
     * Obtiene información para reporte de Avance de proyectos de inversión de lo ejecutado y lo programado
     *
     * @param bool $isQuarter
     * @param array|null $data
     *
     * @return array
     */
    public function getExecutionProjectsAdvanceInvestmentProjects(bool $isQuarter, array $data = null)
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $date = $data['date'] ?? date('d-m-Y');
        $month = Carbon::createFromFormat('d-m-Y', $date)->month;
        $year = Carbon::createFromFormat('d-m-Y', $date)->year;
        $dateEnd = date('d-m-Y');
        $quarter = trans('reports.progress_investment_projects_executed_programmed.quarter1');
        if ($isQuarter) {
            if ($month >= 1 and $month <= 4) {
                $dateEnd = Carbon::createFromFormat('d-m-Y', '01-04-' . $year)->endOfMonth();
                $quarter = trans('reports.progress_investment_projects_executed_programmed.quarter1');
            } elseif ($month >= 5 and $month <= 8) {
                $dateEnd = Carbon::createFromFormat('d-m-Y', '01-08-' . $year)->endOfMonth();
                $quarter = trans('reports.progress_investment_projects_executed_programmed.quarter2');
            } elseif ($month >= 9 and $month <= 12) {
                $dateEnd = Carbon::createFromFormat('d-m-Y', '01-12-' . $year)->endOfMonth();
                $quarter = trans('reports.progress_investment_projects_executed_programmed.quarter3');
            }
        } else {
            $dateEnd = Carbon::createFromFormat('d-m-Y', $date);
        }

        $projectFiscalYears = $this->trackingReportsRepository->getExecutionProjectsAdvanceInvestmentProjects($fiscalYear->id)->map(function ($item)
        use ($dateEnd) {
            $progress = 0;
            $activities = $item->activitiesProjectFiscalYear->filter(function ($activity) use ($dateEnd) {
                return Carbon::parse($activity->date_end) <= $dateEnd;
            })->each(function ($activity) use (&$progress) {
                $progress += $activity->weight_percentage;
            });
            $progress = $progress / (count($activities) == 0 ? 1 : count($activities));
            $item->setAttribute('progress', $progress);
            return $item;
        });

        return [
            'projectFiscalYears' => $projectFiscalYears,
            'date' => $date,
            'gad' => $gadInfo['province'],
            'quarter' => $quarter,
            'date_filter' => $date
        ];
    }

    /**
     * Retorna las actividades administrativas
     *
     * @param array $filters
     *
     * @return mixed
     * @throws Exception
     */
    public function reportAdminActivitiesData(array $filters)
    {
        return DataTables::of($this->adminActivityRepository->findAllByFiltersWithFiles($filters))
            ->setRowId('id')
            ->editColumn('assigned_user_id', function (AdminActivity $entity) {
                return $entity->assigned ? $entity->assigned->fullName() : '';
            })
            ->editColumn('name', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.name', ['entity' => $entity]);
            })
            ->editColumn('status', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.status', ['entity' => $entity]);
            })
            ->editColumn('attachments', function (AdminActivity $entity) {
                return view('business.reports.tracking.admin_activities_and_projects.files', ['files' => $entity->files]);
            })
            ->rawColumns(['name', 'status', 'attachments'])
            ->make(true);
    }

    /**
     * Retorna las actividades administrativas
     *
     * @param array $filters
     *
     * @return mixed
     * @throws Exception
     */
    public function reportProjectActivitiesData(array $filters)
    {
        return DataTables::of($this->trackingReportsRepository->findTasksByFilters($filters))
            ->setRowId('id')
            ->editColumn('responsible', function (Task $entity) {
                return $entity->responsible->count() ? $entity->responsible->first()->fullName() : '';
            })
            ->editColumn('status', function (Task $entity) {
                return trans('physical_progress.labels.' . $entity->status);
            })
            ->addColumn('attachments', function (Task $entity) {
                return view('business.reports.tracking.admin_activities_and_projects.files', ['files' => $entity->files]);
            })
            ->addColumn('description', function (Task $entity) {
                return '';
            })
            ->rawColumns(['name', 'status', 'attachments'])
            ->make(true);
    }

    /**
     * Crear un datatable con la información del POA.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function reformCertificationsReport(int $projectId)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($projectId);
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $budgets = $this->trackingReportsRepository->reformAndCertificationReport($projectFiscalYear, $fiscalYear);
        $activities = $this->projectFiscalYearRepository->findProjectByFiscalYear($projectFiscalYear, $fiscalYear);

        return [
            'data' => $budgets,
            'activities' => $activities
        ];
    }

    /**
     * Obtiene información para grafico de dashboard de avance ejecución física y presupuestaria de proyectos
     *
     * @param array $data
     *
     * @return array
     */
    public function progressDashboardProject()
    {
        $date = date_format(Carbon::now(), 'd-m-Y');
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $gadInfo = $this->settingRepository->findByKey('gad')->value;

        $physical_progress = 0;
        $budget_progress = 0;
        $encoded_total = 0;
        $projectFiscalYears = [];

        if ($fiscalYear) {
            $projectFiscalYearsBudget = $this->trackingReportsRepository->progressExecutionProgress($fiscalYear->year,
                DateTime::createFromFormat('!d-m-Y', $date)->format('Y-m-d'), 4, 9, 4);

            $projectFiscalYears = $this->trackingReportsRepository->getExecutionProjects($fiscalYear->id, $date)->map(function ($item) use (
                $projectFiscalYearsBudget,
                &$budget_progress,
                &$physical_progress,
                &$encoded_total
            ) {
                $project = $projectFiscalYearsBudget->firstWhere('codigo', $item->project->getProgramSubProgramCode());

                if ($project) {
                    $item->setAttribute('encoded', $project->codificado);
                    $item->setAttribute('budget_percent', $project->porciento_ejecucion);
                    $budget_progress += $project->porciento_ejecucion;
                    $encoded_total += $project->codificado;
                } else {
                    $item->setAttribute('encoded', 0);
                    $item->setAttribute('budget_percent', 0);
                }

                $physical_progress += $item->getProgress();

                return $item;
            });
        }

        return [
            'projectFiscalYears' => $projectFiscalYears,
            'date' => $date,
            'gad' => $gadInfo['province'],
            'physical_progress' => count($projectFiscalYears) ? ($physical_progress / count($projectFiscalYears)) : 0,
            'budget_progress' => count($projectFiscalYears) ? ($budget_progress / count($projectFiscalYears)) : 0,
            'encoded_total' => $encoded_total,
            'date_filter' => $date
        ];
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function reformCertificationData(array $data)
    {
        $projectId = $data['projectId'];
        $projectFiscalYear = $this->projectFiscalYearRepository->find($projectId);
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $budgets = $this->trackingReportsRepository->reformAndCertificationReport($projectFiscalYear, $fiscalYear);

        $dataTable = DataTables::of($budgets)
            ->setRowId('id')
            ->editColumn('name_project', function (BudgetItem $entity) {
                return $entity->activityProjectFiscalYear->component->project->name ? $entity->activityProjectFiscalYear->component->project->name : '';
            })
            ->addColumn('description_of_the_beneficiaries', function (BudgetItem $entity) {
                return $entity->activityProjectFiscalYear->component->project->approval_criteria ? $entity->activityProjectFiscalYear->component->project->approval_criteria : '';
            })
            ->addColumn('code_and_name_of_the_place_where_the_activity_takes_place', function (BudgetItem $entity) {
                $result = $entity->geographicLocation->getFullCode($entity->geographicLocation->code) ? $entity->geographicLocation->getFullCode($entity->geographicLocation->code) : '';
                $result2 = $entity->geographicLocation->description ? $entity->geographicLocation->description : '';
                return $result . $result2;
            })
            ->addColumn('project_components', function (BudgetItem $entity) {
                return $entity->activityProjectFiscalYear->component->name ? $entity->activityProjectFiscalYear->component->name : '';
            })
            ->addColumn('activities', function (BudgetItem $entity) {
                return $entity->activityProjectFiscalYear->name ? $entity->activityProjectFiscalYear->name : '';
            })
            ->addColumn('budget_item', function (BudgetItem $entity) {
                return $entity->code ? $entity->code : '';
            })
            ->addColumn('description_of_the_budget_line', function (BudgetItem $entity) {
                return $entity->description ? $entity->description : '';
            })
            ->addColumn('total_amount', function (BudgetItem $entity) {
                return $entity->encoded ? $entity->encoded : '';
            })
            ->addColumn('January', function (BudgetItem $entity) {
                return $entity->jan ? $entity->jan : '';
            })
            ->addColumn('February', function (BudgetItem $entity) {
                return $entity->feb ? $entity->feb : '';
            })
            ->addColumn('March', function (BudgetItem $entity) {
                return $entity->mar ? $entity->mar : '';
            })
            ->addColumn('April', function (BudgetItem $entity) {
                return $entity->apr ? $entity->apr : '';
            })
            ->addColumn('May', function (BudgetItem $entity) {
                return $entity->may ? $entity->may : '';
            })
            ->addColumn('June', function (BudgetItem $entity) {
                return $entity->jun ? $entity->jun : '';
            })
            ->addColumn('July', function (BudgetItem $entity) {
                return $entity->jul ? $entity->jul : '';
            })
            ->addColumn('August', function (BudgetItem $entity) {
                return $entity->aug ? $entity->aug : '';
            })
            ->addColumn('September', function (BudgetItem $entity) {
                return $entity->sep ? $entity->sep : '';
            })
            ->addColumn('October', function (BudgetItem $entity) {
                return $entity->oct ? $entity->oct : '';
            })
            ->addColumn('November', function (BudgetItem $entity) {
                return $entity->nov ? $entity->nov : '';
            })
            ->addColumn('December', function (BudgetItem $entity) {
                return $entity->december ? $entity->december : '';
            })
            ->rawColumns([
                'name_project',
                'description_of_the_beneficiaries',
                'code_and_name_of_the_place_where_the_activity_takes_place',
                'project_components',
                'activities',
                'budget_item',
                'description_of_the_budget_line',
                'total_amount',
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ])
            ->make(true);
        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios para reporte dereformas y certificaciones cronograma de actividades
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function reformCertificationData2(array $data)
    {
        $projectId = $data['projectId'];
        $projectFiscalYear = $this->projectFiscalYearRepository->find($projectId);
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $activities = $this->projectFiscalYearRepository->findProjectByFiscalYear($projectFiscalYear, $fiscalYear);
        $dataTable = DataTables::of($activities)
            ->setRowId('id')
            ->editColumn('name_project', function (Task $entity) {
                return $entity->activityProjectFiscalYear->component->project->name ? $entity->activityProjectFiscalYear->component->project->name : '';
            })
            ->addColumn('description_of_the_beneficiaries', function (Task $entity) {
                return $entity->activityProjectFiscalYear->component->project->approval_criteria ? $entity->activityProjectFiscalYear->component->project->approval_criteria : '';
            })
            ->addColumn('activities', function (Task $entity) {
                $result = $entity->activityProjectFiscalYear->code ? $entity->activityProjectFiscalYear->code : '';
                $result2 = $entity->activityProjectFiscalYear->name ? $entity->activityProjectFiscalYear->name : '';
                return $result . $result2;
            })
            ->addColumn('task', function (Task $entity) {
                if ($entity->type == Task::ELEMENT_TYPE['TASK']) {
                    return $entity->name ? $entity->name : '';
                } else {
                    return '';
                }
            })
            ->addColumn('milestones', function (Task $entity) {
                if ($entity->type == Task::ELEMENT_TYPE['TASK']) {
                    return '';
                } else {
                    return $entity->name ? $entity->name : '';
                }
            })
            ->addColumn('start_date', function (Task $entity) {
                return $entity->date_init ? $entity->date_init : '';
            })
            ->addColumn('end_date', function (Task $entity) {
                return $entity->date_end ? $entity->date_end : '';
            })
            ->addColumn('duration_days', function (Task $entity) {
                return $entity->duration ? $entity->duration : '';
            })
            ->addColumn('importance', function (Task $entity) {
                return $entity->activityProjectFiscalYear->relevance ? $entity->activityProjectFiscalYear->relevance : '';
            })
            ->addColumn('Weighing', function (Task $entity) {
                return $entity->weight_percentage ? $entity->weight_percentage : '';
            })
            ->rawColumns([
                'name_project',
                'description_of_the_beneficiaries',
                'activities',
                'task',
                'milestones',
                'start_date',
                'end_date',
                'duration_days',
                'importance',
                'Weighing'
            ])
            ->make(true);
        return $dataTable;
    }
}
