<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\OperationalGoalsProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase OperationalGoalsController
 * @package App\Http\Controllers\Business\Planning
 */
class OperationalGoalsController extends Controller
{

    /**
     * @var OperationalGoalsProcess
     */
    protected $operationalGoalsProcess;

    /**
     * Constructor OperationalGoalsController.
     *
     * @param OperationalGoalsProcess $operationalGoalsProcess
     */
    public function __construct(
        OperationalGoalsProcess $operationalGoalsProcess
    ) {
        $this->operationalGoalsProcess = $operationalGoalsProcess;
    }

    /**
     * Llamada al proceso para mostrar vista de objetivos operativos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.planning.operational_goals.index',
                $this->operationalGoalsProcess->index()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar la estructura inicial del árbol de objetivos operativos.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function loadStructure()
    {
        try {
            $response = $this->operationalGoalsProcess->loadStructure();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamar al proceso para mostrar el formulario de creación de un objetivo operativo.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $response = $this->operationalGoalsProcess->create($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamar al proceso para crear un nuevo objetivo operativo.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $response = $this->operationalGoalsProcess->store($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra un objetivo operativo.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $response = $this->operationalGoalsProcess->show($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar formulario de edición de un objetivo operativo
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function edit(int $id, Request $request)
    {
        try {

            $response = $this->operationalGoalsProcess->edit($id, $request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar un objetivo operativo
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        try {

            $response = $this->operationalGoalsProcess->update($id, $request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Elimina un objetivo operativo
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $response = $this->operationalGoalsProcess->destroy($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario completo de un indicador
     *
     * @param int $operational_goal_id
     *
     * @return JsonResponse
     */
    public function createFullIndicator(int $operational_goal_id)
    {
        try {
            $response['view'] = view('business.planning.operational_goals.full_indicator.create',
                $this->operationalGoalsProcess->createFullIndicator($operational_goal_id))->render();
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
     * @return JsonResponse
     */
    public function storeFullIndicator(Request $request)
    {
        try {
            $response = $this->operationalGoalsProcess->storeFullIndicator($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function editFullIndicator(int $id, Request $request)
    {
        try {
            $response['view'] = view('business.planning.operational_goals.full_indicator.update',
                $this->operationalGoalsProcess->editFullIndicator($id, $request)
            )->render();
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
     * @return JsonResponse
     */
    public function updateFullIndicator(int $id, Request $request)
    {
        try {
            $response = $this->operationalGoalsProcess->updateFullIndicator($id, $request);
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
            $response['view'] = view('business.planning.operational_goals.full_indicator.show', $this->operationalGoalsProcess->showFullIndicator($id))->render();
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
            $response = $this->operationalGoalsProcess->destroyIndicator($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Duplicar objetivos operativos.
     *
     * @return JsonResponse
     */
    public function replicate()
    {
        try {
            $this->operationalGoalsProcess->replicate();
            return self::index();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}