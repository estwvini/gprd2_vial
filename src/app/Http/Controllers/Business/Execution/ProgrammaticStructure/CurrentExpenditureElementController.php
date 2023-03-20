<?php

namespace App\Http\Controllers\Business\Execution\ProgrammaticStructure;

use App\Http\Controllers\Controller;
use App\Processes\Business\Execution\CurrentExpenditureElementProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase CurrentExpenditureElementController
 * @package App\Http\Controllers\Business\Execution\ProgrammaticStructure
 */
class CurrentExpenditureElementController extends Controller
{
    /**
     * @var CurrentExpenditureElementProcess
     */
    protected $currentExpenditureElementProcess;

    /**
     * Constructor CurrentExpenditureElementController.
     *
     * @param CurrentExpenditureElementProcess $currentExpenditureElementProcess
     */
    public function __construct(
        CurrentExpenditureElementProcess $currentExpenditureElementProcess
    ) {
        $this->currentExpenditureElementProcess = $currentExpenditureElementProcess;
    }

    /**
     * Llamada al proceso para mostrar vista de gasto corriente.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $response['view'] = view('business.execution.programmatic_structure.current_expenditure.index',
                $this->currentExpenditureElementProcess->index()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar la estructura inicial del árbol de gasto corriente.
     *
     * @return mixed
     * @throws Throwable
     */
    public function loadStructure()
    {
        try {
            $response = $this->currentExpenditureElementProcess->loadStructure();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamar al proceso para mostrar el formulario de creación de un elemento de gasto corriente.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->create($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamar al proceso para crear un nuevo elemento de gasto corriente.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->store($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar un elemento de gasto corriente.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $response = $this->currentExpenditureElementProcess->show($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar formulario de edición de un elemento gasto corriente.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function edit(int $id, Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->edit($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar un elemento de gasto corriente.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->update($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Llamada al proceso para eliminar un elemento de gasto corriente.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $response = $this->currentExpenditureElementProcess->destroy($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamar al proceso para mostrar el formulario de creación de actividad operativa.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createOperationalActivity(Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->createOperationalActivity($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamar al proceso para crear una nueva actividad operativa.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeOperationalActivity(Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->storeOperationalActivity($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar una actividad operativa.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function showOperationalActivity(int $id)
    {
        try {
            $response = $this->currentExpenditureElementProcess->showOperationalActivity($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar formulario de edición de actividad operativa.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function editOperationalActivity(int $id, Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->editOperationalActivity($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar una actividad operativa.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateOperationalActivity(int $id, Request $request)
    {
        try {
            $response = $this->currentExpenditureElementProcess->updateOperationalActivity($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Llamada al proceso para eliminar una actividad operativa.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroyOperationalActivity(int $id)
    {
        try {
            $response = $this->currentExpenditureElementProcess->destroyOperationalActivity($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

}