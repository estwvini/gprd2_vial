<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Catalogs\AreaRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\Reports\DashboardRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\SFGPROV\ProformaRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\DataTables;

/**
 * Clase ActivityProjectFiscalYearProcess
 * @package App\Processes\Business\Execution
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
     * @var PlanIndicatorRepository
     */
    private $indicatorRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ProjectFiscalYear
     */
    private $projectFiscalYearRepository;

    /**
     * @var AreaRepository
     */
    private $areaRepository;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var SettingRepository
     */
    private $settingRepository;


    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var ProformaRepository
     */
    private $proformaRepository;

    /**
     * Constructor de ActivityProjectFiscalYearProcess.
     *
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param ProjectRepository $projectRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param PlanIndicatorRepository $indicatorRepository
     * @param AreaRepository $areaRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param ProjectProcess $projectProcess
     * @param SettingRepository $settingRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param ProformaRepository $proformaRepository
     */
    public function __construct(
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        ProjectRepository $projectRepository,
        MeasureUnitRepository $measureUnitRepository,
        PlanIndicatorRepository $indicatorRepository,
        AreaRepository $areaRepository,
        FiscalYearRepository $fiscalYearRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        ProjectProcess $projectProcess,
        SettingRepository $settingRepository,
        BudgetItemRepository $budgetItemRepository,
        ProformaRepository $proformaRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->indicatorRepository = $indicatorRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->areaRepository = $areaRepository;
        $this->projectProcess = $projectProcess;
        $this->settingRepository = $settingRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->proformaRepository = $proformaRepository;
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

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $project->id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        return [$project, $fiscalYear->year, [], $projectFiscalYear->referential_budget, $projectFiscalYear->status];
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

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

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

        if ($entity->budgetItems->count()) {
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

        if ($user->can('budget_items.activities.project.programmatic_structure.execution')) {
            $actions['puzzle-piece'] = [
                'route' => 'budget_items.activities.project.programmatic_structure.execution',
                'tooltip' => trans('activities.actions.planning'),
                'btn_class' => 'btn-primary',
                'ajaxify' => '#view_area'
            ];
        }

        if ($user->can('edit.activities.project.programmatic_structure.execution')) {
            $actions['edit'] = [
                'route' => 'edit.activities.project.programmatic_structure.execution',
                'tooltip' => trans('app.labels.edit'),
                'btn_class' => 'btn-success',
                'scroll-top' => 0
            ];
        }

        if ($user->can('destroy.activities.project.programmatic_structure.execution')) {
            $actions['trash'] = [
                'route' => 'destroy.activities.project.programmatic_structure.execution',
                'tooltip' => trans('app.labels.delete'),
                'btn_class' => 'btn-danger',
                'confirm_message' => trans('activities.messages.confirm.delete'),
                'method' => 'delete',
                'post_action' => '$("#activities_tb").DataTable().draw();'
            ];
        }
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $codified = $this->proformaRepository->getCodifiedExpenses($fiscalYear, $sfgprov->company_code);

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $projectId);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $date = date_format(Carbon::now(), 'Y-m-d');
        $activitiesEncoded = $this->activityProjectFiscalYearRepository->activitiesProjectEncoded($fiscalYear->year, $date, 18, 3, 6,
            $projectFiscalYear->project->getProgramSubProgramCode());

        $activities = $this->activityProjectFiscalYearRepository->findByProjectWithItems($projectFiscalYear->id);
        $totalAmount = 0;
        $activitiesEncoded->each(function ($activity) use (&$totalAmount) {
            $totalAmount += $activity->codificado;
        });

        return DataTables::of($activities)
            ->setRowId('id')
            ->addColumn('area', function ($entity) {
                return $entity->area->area;
            })
            ->addColumn('component', function ($entity) {
                return $entity->component->name;
            })
            ->addColumn('amount', function ($entity) use (&$totalAmount, $activitiesEncoded) {
                $act = $activitiesEncoded->firstWhere('codigo', $entity->code);
                $amount = $act ? $act->codificado : 0;
                return number_format($amount, 2);
            })
            ->addColumn('actions', function ($entity) use ($actions, $projectFiscalYear, $request, $codified) {

                $project = $projectFiscalYear->project;

                if (isset($actions['puzzle-piece'])) {
                    $actions['puzzle-piece']['params'] = [
                        'activityId' => $entity->id,
                        'from_budget_adjustment' => $request->from_budget_adjustment ?: false
                    ];
                }

                if (is_null($project->executingUnit)) {
                    unset($actions['puzzle-piece']);
                }

                if (!$entity->has_budget) {
                    unset($actions['puzzle-piece']);
                }

                if ($codified->whereIn('cuenta', $entity->budgetItems->pluck('code'))->count()) {
                    unset($actions['edit']);
                    unset($actions['trash']);
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

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

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

}
