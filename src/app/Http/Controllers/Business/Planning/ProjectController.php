<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Project;
use App\Processes\Business\Planning\PlanIndicatorProcess;
use App\Processes\Business\Planning\ProjectFiscalYearProcess;
use App\Processes\Business\Planning\ProjectProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ProjectController extends Controller
{
    /**
     * @var ProjectProcess
     */
    protected $projectProcess;

    /**
     * @var PlanIndicatorProcess
     */
    protected $indicatorProcess;

    /**
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * @var ProjectFiscalYearProcess
     */
    protected $projectFiscalYearProcess;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;


    /**
     * Constructor de ProjectController.
     *
     * @param ProjectProcess $projectProcess
     * @param DepartmentRepository $departmentRepository
     * @param PlanIndicatorProcess $indicatorProcess
     * @param ProjectFiscalYearProcess $projectFiscalYearProcess
     * @param MeasureUnitRepository $measureUnitRepository
     */
    public function __construct(
        ProjectProcess $projectProcess,
        DepartmentRepository $departmentRepository,
        PlanIndicatorProcess $indicatorProcess,
        ProjectFiscalYearProcess $projectFiscalYearProcess,
        MeasureUnitRepository $measureUnitRepository
    ) {
        $this->projectProcess = $projectProcess;
        $this->departmentRepository = $departmentRepository;
        $this->indicatorProcess = $indicatorProcess;
        $this->projectFiscalYearProcess = $projectFiscalYearProcess;
        $this->measureUnitRepository = $measureUnitRepository;
    }

    /**
     * Desplegar lista de proyectos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $fiscalYear = $this->projectFiscalYearProcess->nextFiscalYear();
            $response['view'] = view('business.planning.projects.index', ['year' => $fiscalYear->year])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Retorna el formulario para crear un nuevo proyecto.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $now = formatDate(Carbon::now(), 'd-m-Y');
            $departments = $this->departmentRepository->findAll();
            $response['view'] = view('business.planning.projects.create', [
                'registration_date' => $now,
                'departments' => $departments
            ])->render();
            return response()->json($response);

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna formulario para editar la ficha de proyecto
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function editProfile(int $id)
    {
        try {
            $data = $this->projectProcess->editProfile($id);
            $projectPhases = Project::PROJECT_PHASES;
            $response = [
                'view' => view('business.planning.projects.profile', [
                    'entity' => $data[0],
                    'executingUnits' => $data[1],
                    'users' => $data[2],
                    'leader' => $data[3],
                    'projectPhases' => $projectPhases,
                    'urlLoadUsers' => 'loadusers.edit.profile.projects.plans_management',
                    'operationalGoals' => $data[4],
                    'profile' => true,
                    'projectFiscalYear' => $data[5]
                ])->render()
            ];

            return response()->json($response);

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna formulario para editar el marco logico
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function editLogicFrame(int $id)
    {
        try {
            $data = $this->projectProcess->editLogicFrame($id);
            $response = [
                'view' => view('business.planning.projects.logic_frame.index', [
                    'entity' => $data[0],
                    'projectFiscalYear' => $data[1],
                    'logicFrame' => true
                ])->render()
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualiza información de un Proyecto
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $data = $this->projectProcess->update($id, $request);
            $fiscalYear = $this->projectFiscalYearProcess->nextFiscalYear();
            $response['view'] = view('business.planning.projects.index', ['year' => $fiscalYear->year])->render();
            $response['message'] = $data['message'];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Almacena un Proyecto en la BD.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $entity = $this->projectProcess->store($request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.index',
                    ['entity' => $entity])->render(),
                'success' => true,
                'message' => [
                    'type' => 'success',
                    'text' => trans('projects.messages.success.created')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * LLamada al proceso para buscar los usuarios de un departamento
     *
     * @param int $departmentId
     *
     * @return JsonResponse
     */
    public function loadUsers(int $departmentId)
    {
        try {
            return response()->json($this->projectProcess->usersByExecutingUnit($departmentId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Muestra formulario completo de un indicador
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function createFullIndicator(int $projectId)
    {
        try {
            $entity = $this->projectProcess->createFullIndicator($projectId);
            $url = 'update.edit.full_indicator.logic_frame.projects.plans_management';
            $response['view'] = view('business.planning.projects.full_indicator.create', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'projectId' => $projectId,
                'planId' => $projectId,
                'route' => '',
                'url' => $url,
                'yearMeasurement' => date("Y"),
                'startYear' => date("Y", strtotime($entity->date_init)),
                'planType' => Plan::TYPE_PEI,
                'yearPlanning' => date("Y", strtotime($entity->date_end)),
                'justifiable' => false,
                'indicatorable' => PlanIndicator::INDICATORABLE_PROJECT
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Almacena un indicador completo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function storeFullIndicator(Request $request)
    {
        try {
            $entity = $this->projectProcess->storeFullIndicator($request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index', [
                    'indicators' => $entity->indicators,
                    'urlShowFullIndicator' => 'show.full_indicator.logic_frame.projects.plans_management',
                    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.projects.plans_management',
                    'addOrDelete' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.created')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function editFullIndicator(int $projectId)
    {
        try {
            $entity = $this->projectProcess->editFullIndicator($projectId, 'update.edit.full_indicator.logic_frame.projects.plans_management');
            $response['view'] = view('update.edit.full_indicator.projects', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'entity' => $entity,
                'route' => '',
                'planId' => $entity->indicatorable->id,
                'url' => 'update.edit.full_indicator.logic_frame.projects.plans_management',
                'planElementId' => $entity->indicatorable->id,
                'yearMeasurement' => date("Y"),
                'startYear' => date("Y", strtotime($entity->indicatorable->date_init)),
                'planType' => Plan::TYPE_PEI,
                'projectId' => $entity->indicatorable->id,
                'yearPlanning' => date("Y", strtotime($entity->indicatorable->date_end)),
                'justifiable' => false,
                'status' => $entity->indicatorable->status,
                'indicatorable' => PlanIndicator::INDICATORABLE_PROJECT,
                'indicatorId' => $projectId
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza un indicador completo.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function updateFullIndicator(int $id, Request $request)
    {
        try {
            $entity = $this->projectProcess->updateFullIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index', [
                    'indicators' => $entity->indicators,
                    'urlShowFullIndicator' => 'show.full_indicator.logic_frame.projects.plans_management',
                    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.projects.plans_management',
                    'addOrDelete' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Eliminar lógicamente un indicador
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroyIndicator(int $id, Request $request)
    {
        try {
            $entity = $this->projectProcess->destroyIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index',
                    [
                        'indicators' => $entity->indicators,
                        'urlShowFullIndicator' => 'show.full_indicator.logic_frame.projects.plans_management',
                        'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.projects.plans_management',
                        'addOrDelete' => 1
                    ]
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra un indicador completo.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function showFullIndicator(int $id)
    {
        try {
            $response['view'] = view('business.planning.projects.full_indicator.show', $this->projectProcess->showIndicator($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
