<?php

namespace App\Http\Controllers\Business\Execution\ProgrammaticStructure;

use App\Http\Controllers\Controller;
use App\Models\Business\Project;
use App\Processes\Business\Execution\ProjectProcess;
use App\Processes\Business\Planning\ComponentProcess;
use App\Processes\Business\Planning\ProjectProcess as PlanningProjectProcess;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDOException;
use Throwable;

/**
 * Clase ProjectController
 * @package App\Http\Controllers\Execution\ProgrammaticStructure
 */
class ProjectController extends Controller
{

    /**
     * @var ProjectProcess
     */
    protected $projectProcess;

    /**
     * @var PlanningProjectProcess
     */
    protected $planningProjectProcess;

    /**
     * @var ComponentProcess
     */
    protected $componentProcess;

    /**
     * Constructor ProjectController.
     *
     * @param ProjectProcess $projectProcess
     * @param PlanningProjectProcess $planningProjectProcess
     * @param ComponentProcess $componentProcess
     */
    public function __construct(
        ProjectProcess $projectProcess,
        PlanningProjectProcess $planningProjectProcess,
        ComponentProcess $componentProcess
    ) {
        $this->projectProcess = $projectProcess;
        $this->planningProjectProcess = $planningProjectProcess;
        $this->componentProcess = $componentProcess;
    }

    /**
     * Llamada al proceso para mostrar vista de seguimiento de proyectos.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function index()
    {
        try {
            $response['view'] = view('business.execution.programmatic_structure.index', $this->projectProcess->index())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables.
     *
     * @return JsonResponse
     */
    public function data()
    {
        try {
            return $this->projectProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra la pantalla base para la estructura del proyecto
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function structure(int $id)
    {
        try {
            $response['view'] = view('business.execution.programmatic_structure.structure', $this->projectProcess->structure($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra la pantalla del perfil del proyecto
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function profile(int $id)
    {
        try {
            $projectPhases = Project::PROJECT_PHASES;
            $data = $this->planningProjectProcess->editProfile($id);

            $response['view'] = view('business.execution.programmatic_structure.profile', [
                    'entity' => $data[0],
                    'executingUnits' => $data[1],
                    'users' => $data[2],
                    'leader' => $data[3],
                    'projectPhases' => $projectPhases,
                    'operationalGoals' => $data[4]
                ]
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza información de un Proyecto
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateProjectProfile(Request $request, int $id)
    {
        try {
            $data = $this->planningProjectProcess->update($id, $request);
            $response['message'] = $data['message'];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para buscar los usuarios de un departamento
     *
     * @param int $departmentId
     *
     * @return JsonResponse
     */
    public function loadUsers(int $departmentId)
    {
        try {
            return response()->json($this->planningProjectProcess->usersByExecutingUnit($departmentId));
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
    public function logicFrame(int $id)
    {
        try {
            $data = $this->planningProjectProcess->editLogicFrame($id);
            $response = [
                'view' => view('business.execution.programmatic_structure.logic_frame', [
                    'entity' => $data[0]
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
    public function updateLogicFrame(Request $request, int $id)
    {
        try {
            $data = $this->planningProjectProcess->update($id, $request);

            $response['message'] = $data['message'];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna el formulario para crear un nuevo componente.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function createComponent(int $projectId)
    {
        try {
            $response['view'] = view('business.planning.projects.logic_frame.components.create', [
                'urlStoreComponent' => route('store.create.components.logic_frame.project.programmatic_structure.execution', ['projectId' => $projectId])
            ])->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Almacena un componente en la BD.
     *
     * @param Request $request
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function storeComponent(Request $request, int $projectId)
    {
        try {
            $project = $this->componentProcess->store($request, $projectId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $project->components,
                    'urlEditComponent' => 'edit.components.logic_frame.project.programmatic_structure.execution',
                    'urlShowComponent' => 'show.components.logic_frame.project.programmatic_structure.execution',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.project.programmatic_structure.execution',
                    'addOrDelete' => 1,
                    'structureModule' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('components.messages.success.created')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna el formulario para editar un componente.
     *
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function editComponent(int $componentId)
    {
        try {
            $entity = $this->componentProcess->edit($componentId);
            $response['view'] = view('business.planning.projects.logic_frame.components.update', [
                'component' => $entity,
                'urlEditComponent' => 'edit.components.logic_frame.project.programmatic_structure.execution',
                'urlUpdateComponent' => 'update.edit.components.logic_frame.project.programmatic_structure.execution',
                'addOrDelete' => 1,
                'structureModule' => 1
            ])->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualiza un componente en la BD.
     *
     * @param Request $request
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function updateComponent(Request $request, int $componentId)
    {
        try {
            $project = $this->componentProcess->update($request, $componentId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $project->components,
                    'urlEditComponent' => 'edit.components.logic_frame.project.programmatic_structure.execution',
                    'urlShowComponent' => 'show.components.logic_frame.project.programmatic_structure.execution',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.project.programmatic_structure.execution',
                    'addOrDelete' => 1,
                    'structureModule' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('components.messages.success.updated')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Muestra un componente
     *
     * @param int $componentId
     *
     * @return JsonResponse|mixed
     */
    public function showComponent(int $componentId)
    {
        try {
            $entity = $this->componentProcess->edit($componentId);
            $response['view'] = view('business.planning.projects.logic_frame.components.show', [
                'component' => $entity,
                'urlShowComponent' => 'show.components.logic_frame.project.programmatic_structure.execution',
                'addOrDelete' => 1,
                'structureModule' => 1
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar lógicamente un componente.
     *
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function destroyComponent(int $componentId)
    {
        try {
            $entity = $this->componentProcess->destroy($componentId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $entity->components,
                    'urlEditComponent' => 'edit.components.logic_frame.project.programmatic_structure.execution',
                    'urlShowComponent' => 'show.components.logic_frame.project.programmatic_structure.execution',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.project.programmatic_structure.execution',
                    'addOrDelete' => 1,
                    'structureModule' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('components.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Verifica el estado del proyecto para su reestructuración
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function checkProjectStatus(int $id)
    {
        try {
            $response = $this->projectProcess->checkProjectStatus($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza a 0 los montos de todas las partidas presupuestarias y compras públicas del proyecto
     * Recalcula la ponderación de todas las tareas en base a presupuesto cero
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function resetBudgetItems(int $id)
    {
        try {
            $response = $this->projectProcess->resetBudgetItems($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Inicia la ejecución de un proyecto
     * Envía todas las partidas presupuestarias del proyecto al sistema financiero para poder ser utilizadas en una reforma
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function start(int $id)
    {
        try {
            $this->projectProcess->start($id);

            $response = [
                'view' => view('business.execution.programmatic_structure.index',
                    $this->projectProcess->index())
                    ->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('project_structure.messages.success.created')
                ]
            ];
        } catch (PDOException $e) {
            return defaultCatchHandler(new Exception(trans('app.messages.exceptions.sfgprov_not_available'), 2000, $e));
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}