<?php

namespace App\Processes\Business\Planning;

use App\Events\ActivityAreaChanged;
use App\Events\ActivityCodeChanged;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\BudgetPlanning;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Repositories\Repository\Business\Catalogs\AreaRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\BudgetPlanningRepository;
use App\Repositories\Repository\Business\Planning\CurrentExpenditureElementRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\Tracking\ReformRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\DataTables;

/**
 * Clase ActivityProjectFiscalYearProcess
 * @package App\Processes\Business\Planning
 */
class ActivityProjectFiscalYearProcess
{

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * @var PlanIndicatorProcess
     */
    private $indicatorProcess;

    /**
     * @var PlanIndicatorRepository
     */
    private $indicatorRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var BudgetPlanningRepository
     */
    private $budgetPlanningRepository;

    /**
     * @var ProjectFiscalYear
     */
    private $projectFiscalYearRepository;

    /**
     * @var AreaRepository
     */
    private $areaRepository;

    /**
     * @var CurrentExpenditureElementRepository
     */
    private $currentExpenditureElementRepository;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var ReformRepository
     */
    private $reformRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * Constructor de ActivityProjectFiscalYearProcess.
     *
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param ProjectRepository $projectRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param PlanIndicatorProcess $indicatorProcess
     * @param PlanIndicatorRepository $indicatorRepository
     * @param AreaRepository $areaRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param BudgetPlanningRepository $budgetPlanningRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param CurrentExpenditureElementRepository $currentExpenditureElementRepository
     * @param ProjectProcess $projectProcess
     * @param ReformRepository $reformRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        ProjectRepository $projectRepository,
        MeasureUnitRepository $measureUnitRepository,
        PlanIndicatorProcess $indicatorProcess,
        PlanIndicatorRepository $indicatorRepository,
        AreaRepository $areaRepository,
        FiscalYearRepository $fiscalYearRepository,
        BudgetPlanningRepository $budgetPlanningRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        CurrentExpenditureElementRepository $currentExpenditureElementRepository,
        ProjectProcess $projectProcess,
        ReformRepository $reformRepository,
        SettingRepository $settingRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->indicatorProcess = $indicatorProcess;
        $this->indicatorRepository = $indicatorRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->budgetPlanningRepository = $budgetPlanningRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->areaRepository = $areaRepository;
        $this->currentExpenditureElementRepository = $currentExpenditureElementRepository;
        $this->projectProcess = $projectProcess;
        $this->reformRepository = $reformRepository;
        $this->settingRepository = $settingRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
    }

    /**
     * Obtiene información para listado de actividades
     *
     * @param int $projectId
     *
     * @return array
     * @throws Exception
     */
    public function index(int $projectId)
    {
        $project = $this->projectRepository->find($projectId);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $project->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $activities = $this->activityProjectFiscalYearRepository->findByProjectFiscalYear($projectFiscalYear->id);

        $data = self::dataBudgetPlanning($activities, $projectFiscalYear);

        return [$project, $fiscalYear->year, $data, $projectFiscalYear->referential_budget, $projectFiscalYear->status, $projectFiscalYear];
    }

    /**
     * Obtiene información para crear una actividad
     *
     * @param int $projectId
     *
     * @return array
     * @throws Exception
     */
    public function create(int $projectId)
    {
        $project = $this->projectRepository->find($projectId);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $project->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        return [$projectFiscalYear, self::areas(), $project->components];
    }

    /**
     * Editar una actividad
     *
     * @param int $id
     *
     * @return ActivityProjectFiscalYear
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->activityProjectFiscalYearRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('activities.messages.errors.not_found'), 1000);
        }

        return $entity;
    }

    /**
     * Almacena una nueva actividad
     *
     * @param Request $request
     *
     * @return ActivityProjectFiscalYear
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($request['has_budget']) && $request['has_budget'] == 'on') {
            $data['has_budget'] = $request['has_budget_sent'];
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->find($data['project_fiscal_year_id']);

        if (!$projectFiscalYear) {
            throw new Exception(trans('activities.messages.exceptions.project_not_found'), 1000);
        }

        $entity = $this->activityProjectFiscalYearRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('activities.messages.errors.create'), 1000);
        }

        return $entity;
    }

    /**
     * Edita una actividad
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $activity = $this->activityProjectFiscalYearRepository->find($id);

        if (!$activity) {
            throw new Exception(trans('activities.messages.exceptions.not_found'), 1000);
        }

        $request['has_budget'] = isset($request['has_budget']) ? ($request['has_budget'] == 'on' ? 1 : 0) : 0;

        $entity = $this->activityProjectFiscalYearRepository->updateFromArray($request->all(), $activity);

        if (!$entity) {
            throw new Exception(trans('activities.messages.errors.update'), 1000);
        }

        if (isset($request['code']) && key_exists('code', $activity->getChanges())) {
            event(new ActivityCodeChanged($activity));
        }

        if (isset($request['area_id']) && key_exists('area_id', $activity->getChanges())) {
            event(new ActivityAreaChanged($activity));
        }
    }

    /**
     * Eliminar lógicamente una actividad.
     *
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function destroy(int $id)
    {
        $entity = $this->activityProjectFiscalYearRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('activities.messages.exceptions.not_found'), 1000);
        }

        if ($entity->budgetItems->count() || $entity->tasks->count()) {
            throw new Exception(trans('activities.messages.exceptions.activity_is_not_empty'), 1000);
        }

        if (!$this->activityProjectFiscalYearRepository->destroy($entity->id)) {
            throw new Exception(trans('activities.messages.errors.delete'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('activities.messages.success.deleted')
            ]
        ];

        return $response;
    }

    /**
     * lista las areas
     *
     * @return ActivityProjectFiscalYear
     * @throws Exception
     */
    public function areas()
    {
        $entities = $this->areaRepository->findAll();

        if (!$entities) {
            throw new Exception(trans('activities.messages.exceptions.not_found'), 1000);
        }

        return $entities;
    }

    /**
     * Obtiene información para las actividades de un subrprograma de Gasto Corriente.
     *
     * @param int $subprogramId
     *
     * @return array
     * @throws Exception
     */
    public function currentExpenditurePlanningIndex(int $subprogramId)
    {
        $subprogram = $this->currentExpenditureElementRepository->find($subprogramId);

        if (!$subprogram) {
            throw new Exception(trans('current_expenditure.messages.exceptions.not_found',
                ['element' => trans('current_expenditure.labels.SUBPROGRAM')]), 1000);
        }

        $activities = $subprogram->activities;

        $data = self::dataBudgetPlanning($activities);

        return [
            'subprogram' => $subprogram,
            'budgetPlanning' => json_encode($data, JSON_HEX_APOS | JSON_HEX_QUOT)
        ];
    }

    /**
     * Obtiene información de la planificación de actividades, partidas presupuestarias y compras públicas
     *
     * @param Collection $activities
     * @param ProjectFiscalYear|null $projectFiscalYear
     *
     * @return array
     */
    public function dataBudgetPlanning(Collection $activities, ProjectFiscalYear $projectFiscalYear = null)
    {
        $data = [];
        $index = 0;

        $activities->each(function ($activity) use (&$data, &$index, $projectFiscalYear) {
            $parent = $index;

            if ($activity instanceof OperationalActivity) {
                if (!$activity->budgetItems()->count()) {
                    return;
                }
                $activity->load('budgetItems');
            } else {
                if (!$activity->budgetItems()->count()) {
                    return;
                }
                $activity->load('budgetItems');
            }
            $row = [
                'id' => $index,
                'primaryId' => $activity->id,
                'name' => $activity->code . ' - ' . $activity->name,
                'parent' => null,
                'indent' => 0,
                'editable' => false,
                'total' => $activity->budgetItems->sum('amount')
            ];
            $monthsAct = BudgetPlanning::EMPTY_MONTH;
            $data[] = $row;
            $index++;
            $activity->budgetItems->each(function ($item) use (&$data, &$index, $parent, &$monthsAct) {
                $row = [
                    'id' => $index,
                    'primaryId' => $item->id,
                    'name' => $item->budgetClassifier->full_code . ' - ' . $item->budgetClassifier->title,
                    'parent' => $parent,
                    'indent' => 1,
                    'editable' => true,
                    'total' => $item->amount
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
     * Crear un datatable con la información pertinente de actividades.
     *
     * @param int $projectId
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function data(int $projectId, Request $request)
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('index.items.activities.projects.plans_management')) {
            $actions['puzzle-piece'] = [
                'route' => 'index.items.activities.projects.plans_management',
                'tooltip' => trans('activities.actions.planning'),
                'btn_class' => 'btn-primary'
            ];
        }

        if ($user->can('edit.activities.projects.plans_management')) {
            $actions['edit'] = [
                'route' => 'edit.activities.projects.plans_management',
                'tooltip' => trans('app.labels.edit'),
                'btn_class' => 'btn-success'
            ];
        }

        if ($user->can('destroy.activities.projects.plans_management')) {
            $actions['trash'] = [
                'route' => 'destroy.activities.projects.plans_management',
                'tooltip' => trans('app.labels.delete'),
                'btn_class' => 'btn-danger',
                'confirm_message' => trans('activities.messages.confirm.delete'),
                'method' => 'delete',
                'post_action' => '$("#activities_tb").DataTable().draw();'
            ];
        }

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $projectId);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $project = $this->projectRepository->find($projectId);

        $activities = $this->activityProjectFiscalYearRepository->findByProjectWithItems($projectFiscalYear->id);
        $totalAmount = 0;
        $activities->each(function ($activity) use (&$totalAmount) {
            $totalAmount += $activity->budgetItems->sum('amount');
        });

        $dataTable = DataTables::of($activities)
            ->setRowId('id')
            ->addColumn('area', function ($entity) {
                return $entity->area ? $entity->area->area : '';
            })
            ->addColumn('component', function ($entity) {
                return $entity->component ? $entity->component->name : '';
            })
            ->addColumn('amount', function ($entity) {
                return number_format($entity->budgetItems->sum('amount'), 2);
            })
            ->addColumn('actions', function ($entity) use ($actions, $project, $request, $user) {

                if (isset($actions['puzzle-piece'])) {
                    if (is_null($project->executingUnit)) {
                        unset($actions['puzzle-piece']);
                    }

                    if (!$entity->has_budget) {
                        unset($actions['puzzle-piece']);
                    }

                    if (isset($actions['puzzle-piece'])) {
                        $actions['puzzle-piece']['params'] = [
                            'activityId' => $entity->id,
                            'from_budget_adjustment' => $request->from_budget_adjustment ?: false
                        ];
                    }
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->editColumn('has_budget', function ($entity) {
                $label = $entity->has_budget ? ActivityProjectFiscalYear::YES : ActivityProjectFiscalYear::NO;
                $class = $entity->has_budget ? 'success' : 'danger';
                return "<span class='label label-{$class}'>{$label}</span>";
            })
            ->rawColumns(['actions', 'has_budget'])
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Crear un datatable con la información pertinente de actividades.
     *
     * @param int $projectId
     *
     * @return mixed
     * @throws Exception
     */
    public function dataShow(int $projectId)
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('items.activities.projects_review.plans_management')) {
            $actions['search'] = [
                'route' => 'items.activities.projects_review.plans_management',
                'tooltip' => trans('activities.labels.detail'),
                'btn_class' => 'btn-primary'
            ];
        }

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $projectId);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $activities = $this->activityProjectFiscalYearRepository->findByProjectWithItems($projectFiscalYear->id);
        $totalAmount = 0;
        $activities->each(function ($activity) use (&$totalAmount) {
            $totalAmount += $activity->budgetItems->sum('amount');
        });

        $dataTable = DataTables::of($activities)
            ->setRowId('id')
            ->addColumn('area', function ($entity) {
                return $entity->area->area;
            })
            ->addColumn('component', function ($entity) {
                return $entity->component->name;
            })
            ->addColumn('amount', function ($entity) {
                return number_format($entity->budgetItems->sum('amount'), 2);
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                if ($entity->has_budget) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                } else {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => []
                    ]);
                }
            })
            ->editColumn('has_budget', function ($entity) {
                return $entity->has_budget ? ActivityProjectFiscalYear::YES : ActivityProjectFiscalYear::NO;
            })
            ->rawColumns(['actions', 'budget'])
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene información para mostrar formulario de una actividad
     *
     * @param int $activityId
     *
     * @return array
     * @throws Exception
     */
    public function budgetItems(int $activityId)
    {
        $activity = $this->activityProjectFiscalYearRepository->find($activityId);

        if (!$activity) {
            throw new Exception(trans('activities.messages.errors.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $activity->component->project->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $activities = $this->activityProjectFiscalYearRepository->findByProjectWithItems($projectFiscalYear->id);
        $totalAmount = 0;
        $activities->each(function ($activity) use (&$totalAmount) {
            $totalAmount += $activity->budgetItems->sum('amount');
        });

        return [$activity->component->project, $activity, $fiscalYear->year, $projectFiscalYear->referential_budget, $totalAmount];
    }

    /**
     * Almacena las planificaciones de los presupuestos mensuales
     *
     * @param int $projectId
     * @param array $data
     * @param bool $isPlanning
     * @param bool $isProject
     *
     * @throws Exception
     */
    public function storeBudgetPlanning(int $projectId, array $data, bool $isPlanning, bool $isProject = true)
    {
        $this->budgetPlanningRepository->createMany($data, $isPlanning);
        if ($isProject && !$isPlanning) {

            $projectFiscalYear = $this->projectFiscalYearRepository->find($projectId);

            if (!$projectFiscalYear) {
                throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
            }
            $projectCodes[] = $projectFiscalYear->project->getProgramSubProgramCode();

            $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
            $projectFiscalYear = $this->projectFiscalYearRepository->findProjectsWithReforms($sfgprov->company_code, $projectFiscalYear->fiscalYear->year, $projectCodes,
                collect([$projectFiscalYear]))->first();

            if (!$projectFiscalYear) {
                throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
            }
            $projectFiscalYear->total_reform = $projectFiscalYear->reform ?? 0;
            $projectFiscalYear->reform_date = null;
            unset($projectFiscalYear->reform);
            unset($projectFiscalYear->project_code);
            $projectFiscalYear->save();
        }
    }
}
