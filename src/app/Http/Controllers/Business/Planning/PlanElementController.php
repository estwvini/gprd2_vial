<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\PlanElementProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase PlanElementController
 * @package App\Http\Controllers\Business\Planning
 */
class PlanElementController extends Controller
{

    /**
     * @var PlanElementProcess
     */
    protected $planElementProcess;

    /**
     * Constructor PlanElementController.
     *
     * @param PlanElementProcess $planElementProcess
     */
    public function __construct(
        PlanElementProcess $planElementProcess
    ) {
        $this->planElementProcess = $planElementProcess;
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @param Request $request
     *
     * @return string
     */
    public function data(Request $request)
    {
        try {
            return $this->planElementProcess->data($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }

    }

    /**
     * Mostrar formulario para crear nuevo elemento de un plan
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            return $this->planElementProcess->create($request);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Almacenar un nuevo elemento de un plan.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $response = $this->planElementProcess->store($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra un elemento de un plan en específico.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->show($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar formulario de edición de un elemento de un plan
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function edit(int $id, Request $request)
    {
        try {

            $response = $this->planElementProcess->edit($id, $request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar un elemento de un plan
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        try {

            $response = $this->planElementProcess->update($id, $request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Elimina un elemento de un plan.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroy(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->destroy($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }


    /**
     * Muestra formulario reducido de un indicador
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createSmallIndicator(Request $request)
    {
        try {
            $response = $this->planElementProcess->createSmallIndicator($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario completo de un indicador
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createFullIndicator(Request $request)
    {
        try {
            $response = $this->planElementProcess->createFullIndicator($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacena un indicador reducido.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeSmallIndicator(Request $request)
    {
        try {
            $response = $this->planElementProcess->storeSmallIndicator($request);
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
            $response = $this->planElementProcess->storeFullIndicator($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra un indicador reducido.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function showSmallIndicator(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->showSmallIndicator($id, $request);
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
            $response['view'] = view('business.planning.plan_element.full_indicator.show', $this->planElementProcess->showFullIndicator($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario de edición de un indicador reducido.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function editSmallIndicator(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->editSmallIndicator($id, $request);
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
            $response = $this->planElementProcess->editFullIndicator($id, $request, 'update.edit.full.indicator.plan_elements.plans.plans_management');
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza un indicador reducido.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateSmallIndicator(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->updateSmallIndicator($id, $request);
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
            $response = $this->planElementProcess->updateFullIndicator($id, $request);
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
            $response = $this->planElementProcess->destroyIndicator($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario de un proyecto
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createProject(Request $request)
    {
        try {
            $response = $this->planElementProcess->createProject($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacena un proyecto.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeProject(Request $request)
    {
        try {
            $this->planElementProcess->storeProject($request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('projects.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario de edición de un proyecto.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function editProject(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->editProject($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza un proyecto.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateProject(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->updateProject($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga campos para ingreso de presupuestos anuales
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadAnnualBudgets(Request $request)
    {
        try {
            $response = $this->planElementProcess->loadAnnualBudgets($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el detalle de un proyecto.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function showProject(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->showProject($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Eliminar lógicamente un proyecto
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroyProject(int $id, Request $request)
    {
        try {
            $response = $this->planElementProcess->destroyProject($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
