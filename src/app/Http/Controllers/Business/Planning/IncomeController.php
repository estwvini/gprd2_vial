<?php

namespace App\Http\Controllers\Business\Planning;

use App\Exports\DefaultReportExport;
use App\Http\Controllers\Controller;
use App\Imports\Incomes\IncomeItems;
use App\Models\Business\Planning\Income;
use App\Processes\Business\Planning\BudgetAdjutmentProcess;
use App\Processes\Business\Planning\IncomeProcess;
use App\Repositories\Repository\Business\Planning\IncomeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

/**
 * Clase IncomeController
 * @package App\Http\Controllers\Business\Planning
 */
class IncomeController extends Controller
{

    /**
     * @var IncomeProcess
     */
    protected $incomeProcess;

    /**
     * @var BudgetAdjutmentProcess
     */
    protected $budgetAdjutmentProcess;

    /**
     * @var IncomeRepository
     */
    private $incomeRepository;

    /**
     * Constructor IncomeController.
     *
     * @param IncomeProcess $incomeProcess
     * @param BudgetAdjutmentProcess $budgetAdjutmentProcess
     * @param IncomeRepository $incomeRepository
     */
    public function __construct(
        IncomeProcess $incomeProcess,
        BudgetAdjutmentProcess $budgetAdjutmentProcess,
        IncomeRepository $incomeRepository
    ) {
        $this->incomeProcess = $incomeProcess;
        $this->budgetAdjutmentProcess = $budgetAdjutmentProcess;
        $this->incomeRepository = $incomeRepository;
    }

    /**
     * Mostrar lista de ingresos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $params = $this->incomeProcess->index(Income::MODULE['BUDGET']);
            $response['view'] = view('business.planning.income.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de ingresos.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->incomeProcess->data(Income::MODULE['BUDGET']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar formulario de creación de ingresos
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $params = $this->incomeProcess->create(Income::MODULE['BUDGET']);
            $response['modal'] = view('business.planning.income.create', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacenar nuevo ingreso
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->incomeProcess->store($request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('income.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar formulario de edición de un ingreso
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $params = $this->incomeProcess->edit($id, Income::MODULE['BUDGET']);
            $response['modal'] = view('business.planning.income.update', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar un ingreso
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->incomeProcess->update($request, $id);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('income.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Mostrar información de un ingreso
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $params = $this->incomeProcess->show($id);
            $response['modal'] = view('business.planning.income.show', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Elimina un ingreso
     *
     * @param int $id
     *
     * @return mixed
     */
    public function destroy(int $id)
    {
        try {
            $this->incomeProcess->destroy($id, Income::MODULE['BUDGET']);
            $params = $this->incomeProcess->index(Income::MODULE['BUDGET']);
            $response = [
                'view' => view('business.planning.income.index', $params)->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('income.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Obtiene los datos presupuestarios
     *
     * @return JsonResponse
     */
    public function loadBudgetSummary()
    {
        try {
            $response['view'] = view('business.planning.budget_adjustment.load_budget_summary',
                $this->budgetAdjutmentProcess->loadBudgetSummary()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Duplicar presupuesto de ingresos.
     *
     * @return JsonResponse
     */
    public function replicate()
    {
        try {
            $this->incomeProcess->replicate();
            return self::index();
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
            $response['modal'] = view('business.planning.income.import')->render();
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
            $this->incomeProcess->removeAll();

            $import = new IncomeItems;
            $import->import($request->file('file'));
            $params = $this->incomeProcess->index(Income::MODULE['BUDGET']);

            $response['view'] = view('business.planning.income.index', $params)->render();
            return response()->json($response);
        } catch (ValidationException $e) {
            $params = $this->incomeProcess->index(Income::MODULE['BUDGET']);
            $response['view'] = view('business.planning.income.index',
                array_merge([
                    'failures' => collect($e->failures())
                ], $params)
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
            $data = $this->incomeRepository->findAll(Income::MODULE['BUDGET']);
            $view = view('business.planning.income.export', ['rows' => $data]);

            return Excel::download(new DefaultReportExport($view), trans('income.labels.file') . '.xlsx');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }
}