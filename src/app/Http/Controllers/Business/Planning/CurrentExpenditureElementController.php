<?php

namespace App\Http\Controllers\Business\Planning;

use App\Exports\DefaultReportExport;
use App\Http\Controllers\Controller;
use App\Imports\Expenses\BudgetItems;
use App\Processes\Business\Planning\BudgetAdjutmentProcess;
use App\Processes\Business\Planning\CurrentExpenditureElementProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

/**
 * Clase CurrentExpenditureElementController
 *
 * @package App\Http\Controllers\Business\Planning
 */
class CurrentExpenditureElementController extends Controller
{
    /**
     * @var CurrentExpenditureElementProcess
     */
    protected $currentExpenditureElementProcess;

    /**
     * @var BudgetAdjutmentProcess
     */
    protected $budgetAdjutmentProcess;

    /**
     * Constructor CurrentExpenditureElementController.
     *
     * @param CurrentExpenditureElementProcess $currentExpenditureElementProcess
     * @param BudgetAdjutmentProcess $budgetAdjutmentProcess
     */
    public function __construct(
        CurrentExpenditureElementProcess $currentExpenditureElementProcess,
        BudgetAdjutmentProcess $budgetAdjutmentProcess
    ) {
        $this->currentExpenditureElementProcess = $currentExpenditureElementProcess;
        $this->budgetAdjutmentProcess = $budgetAdjutmentProcess;
    }

    /**
     * Llamada al proceso para mostrar vista de gasto corriente.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.planning.current_expenditure.index',
                $this->currentExpenditureElementProcess->index()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar replicar el gasto corriente.
     *
     * @return JsonResponse
     */
    public function replicate()
    {
        try {
            $this->currentExpenditureElementProcess->replicateBudget();
            return self::index();
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

    /**
     * Obtiene los datos presupuestarios
     *
     * @return JsonResponse
     */
    public function loadBudgetSummary()
    {
        try {
            $response['view'] = view('business.planning.budget_adjustment.load_budget_summary', $this->budgetAdjutmentProcess->loadBudgetSummary())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Importar presupuesto desde archivo excel
     *
     * @return JsonResponse
     */
    public function importModal()
    {
        try {
            $response['modal'] = view('business.planning.current_expenditure.import')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Importar presupuesto desde archivo excel
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function import(Request $request)
    {
        try {
            $this->currentExpenditureElementProcess->deleteAll();

            $import = new BudgetItems();
            $import->import($request->file('file'));

            $response['view'] = view('business.planning.current_expenditure.index',
                $this->currentExpenditureElementProcess->index()
            )->render();
            return response()->json($response);
        } catch (ValidationException $e) {
            $response['view'] = view('business.planning.current_expenditure.index',
                array_merge([
                    'failures' => collect($e->failures())
                ], $this->currentExpenditureElementProcess->index())
            )->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
        }
    }

    /**
     * Descarga el prespuesto de ingresos.
     *
     * @return mixed|string
     */
    public function download()
    {
        try {

            $data = $this->currentExpenditureElementProcess->download();
            $view = view('business.planning.current_expenditure.export', ['rows' => $data]);

            return Excel::download(new DefaultReportExport($view), trans('current_expenditure.labels.file') . '.xlsx');
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
        }
    }
}