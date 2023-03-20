<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\PlanIndicator;
use App\Models\Business\Plan;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ProjectsReviewProcess
 * @package App\Processes\Business\Planning
 */
class ProjectsReviewProcess
{
    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

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
     * @var OperationalGoalsRepository
     */
    private $operationalGoalsRepository;

    /**
     * Constructor de ProjectsReviewProcess.
     *
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectRepository $projectRepository
     * @param SettingRepository $settingRepository
     * @param DepartmentRepository $departmentRepository
     * @param UserRepository $userRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param PlanIndicatorProcess $indicatorProcess
     * @param PlanIndicatorRepository $indicatorRepository
     * @param OperationalGoalsRepository $operationalGoalsRepository
     */
    public function __construct(
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository,
        ProjectRepository $projectRepository,
        SettingRepository $settingRepository,
        DepartmentRepository $departmentRepository,
        UserRepository $userRepository,
        MeasureUnitRepository $measureUnitRepository,
        PlanIndicatorProcess $indicatorProcess,
        PlanIndicatorRepository $indicatorRepository,
        OperationalGoalsRepository $operationalGoalsRepository
    ) {
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectRepository = $projectRepository;
        $this->settingRepository = $settingRepository;
        $this->departmentRepository = $departmentRepository;
        $this->userRepository = $userRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->indicatorProcess = $indicatorProcess;
        $this->indicatorRepository = $indicatorRepository;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
    }

    /**
     * Retorna los datos para la pantalla inicial de revisión de proyectos
     *
     * @return array
     */
    public function index()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        return [
            'year' => $fiscalYear->year ?? Carbon::now()->addYear()->year
        ];
    }

    /**
     * Crear un datatable con la información pertinente de departamentos.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('edit.profile.projects_review.plans_management')) {
            $actions['dot-circle-o'] = [
                'route' => 'edit.profile.projects_review.plans_management',
                'tooltip' => trans('projects.actions.profile'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('modify.logic_frame.projects_review.plans_management')) {
            $actions['file-text'] = [
                'route' => 'modify.logic_frame.projects_review.plans_management',
                'tooltip' => trans('projects.actions.logic_frame'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('list.activities.projects_review.plans_management')) {
            $actions['puzzle-piece'] = [
                'route' => 'list.activities.projects_review.plans_management',
                'tooltip' => trans('projects.actions.activities'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('index_show.schedule.projects_review.plans_management')) {
            $actions['calendar'] = [
                'route' => 'index_show.schedule.projects_review.plans_management',
                'tooltip' => trans('projects.actions.schedule'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('indexshow.projects_review.plans_management')) {
            $actions['paperclip'] = [
                'route' => 'indexshow.projects_review.plans_management',
                'tooltip' => trans('projects.actions.attachments'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('rejections_log.projects_review.plans_management')) {
            $actions['folder-open'] = [
                'route' => 'rejections_log.projects_review.plans_management',
                'tooltip' => trans('rejections.labels.rejectionsLog'),
                'method' => 'GET',
                'btn_class' => 'btn-warning'
            ];
        }
        if ($user->can('attachments_roads_show.projects_review.plans_management')) {
            $actions['road'] = [
                'route' => 'attachments_roads_show.projects_review.plans_management',
                'tooltip' => trans('projects.actions.attachments_roads'),
                'btn_class' => 'btn-primary'
            ];
        }

        $dataTable = DataTables::of($this->projectFiscalYearRepository->findByUserDepartmentsToReview($this->fiscalYearRepository->findNextFiscalYear()))
            ->setRowId('id')
            ->addColumn('bulk_action', function (ProjectFiscalYear $entity) {
                return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->id}' />";
            })
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
            ->addColumn('actions', function (ProjectFiscalYear $entity) use ($actions, $user) {

                if ($entity->rejections->count() && isset($actions['folder-open'])) {
                    $actions['folder-open']['params'] = [
                        'project_fiscal_year_id' => $entity->id
                    ];
                } else {
                    unset($actions['folder-open']);
                }

                if (!$entity->project->is_road) {
                    unset($actions['road']);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity->project,
                    'actions' => $actions,
                    'entity_status' => $entity->status
                ]);

            })
            ->rawColumns(['responsibleUnit', 'referential_budget', 'actions', 'bulk_action'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene información para el formulario de marco logico del proyecto
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function editLogicFrame(int $id)
    {
        $projectFiscalYearRepository = $this->projectFiscalYearRepository->findByYearAndProject($this->fiscalYearRepository->findNextFiscalYear()->id, $id);

        $entity = $this->projectRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        return [$entity, $projectFiscalYearRepository->status];
    }

    /**
     * Obtiene información para el formulario de perfil de proyecto
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function editProfile(int $id)
    {
        $entity = $this->projectRepository->find($id);

        $projectFiscalYearRepository = $this->projectFiscalYearRepository->findByYearAndProject($this->fiscalYearRepository->findNextFiscalYear()->id, $id);

        if (!$entity) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $executingUnits = $this->departmentRepository->childrenDepartments($entity->responsibleUnit->id, ['id', 'name']);

        if (!count($executingUnits)) {
            $executingUnits->push($entity->responsibleUnit);
        }

        $operationalGoals = $this->operationalGoalsRepository->findByField('plan_element_id', $entity->subprogram->parent->parent->id);

        $users = [];
        if ($entity->executingUnit) {
            $users = $this->usersByExecutingUnit($entity->executingUnit->id);
        }

        $leader = $entity->activeLeader();

        return [$entity, $executingUnits, $users, $leader, $projectFiscalYearRepository->status, $operationalGoals];
    }

    /**
     * Obtiene los usuarios de una unidad ejecutora
     *
     * @param int $id
     *
     * @return mixed
     */
    public function usersByExecutingUnit(int $id)
    {
        return $this->userRepository->findLeadersByDepartment($id, ['users.id', 'users.first_name', 'users.last_name']);
    }

    /**
     * Mostrar formulario de edición de un indicador completo
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function showFullIndicator(int $id)
    {
        $entity = $this->indicatorRepository->find($id);

        if (!is_null($entity->measurement_frequency_per_year)) {
            $measuring_frequency = (date("Y", strtotime($entity->indicatorable->date_end)) - date("Y",
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

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }
        $response['view'] = view('business.planning.project_review.full_indicator.show', [
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'measuringUnit' => isset($entity->measureUnit) ? $entity->measureUnit->name : '',
            'type' => $type,
            'goal_type' => $goal_type,
            'measuring_frequency' => $measuring_frequency,
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'entity' => $entity,
            'route' => '',
            'planId' => $entity->indicatorable->id,
            'url' => '',
            'planElementId' => $entity->indicatorable->id,
            'yearMeasurement' => date("Y"),
            'startYear' => date("Y", strtotime($entity->indicatorable->date_init)),
            'planType' => Plan::TYPE_PEI,
            'projectId' => $entity->indicatorable->id,
            'yearPlanning' => date("Y", strtotime($entity->indicatorable->date_end)),
            'justifiable' => false,
            'status' => $entity->indicatorable->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_PROJECT,
            'indicatorId' => $id

        ])->render();

        return $response;
    }

    /**
     * Cambiar estado del proyecto
     *
     * @param Request $request
     * @param string $status
     *
     * @return mixed
     */
    public function bulkChange(Request $request, string $status)
    {

        if (is_array($request->ids)) {
            $entities = $this->projectFiscalYearRepository->findByIds($request->ids);

            foreach ($entities as $entity) {
                $this->projectFiscalYearRepository->changeState($entity, $status);
            }
        } else {
            $entity = $this->projectFiscalYearRepository->find($request->ids);

            $currentUser = currentUser();

            $rejectData = [
                'observations' => $request->observations,
                'user_id' => $currentUser->id
            ];

            $this->projectFiscalYearRepository->changeState($entity, $status, $rejectData);

        }

        $response['message'] = [
            'type' => 'success',
            'text' => trans('project_review.messages.success.updated_bulk')
        ];

        return $response;
    }

}