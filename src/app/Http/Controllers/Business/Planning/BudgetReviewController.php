<?php

namespace App\Http\Controllers\Business\Planning;

use App\Exports\DefaultReportExport;
use App\Http\Controllers\Controller;
use App\Models\Business\BudgetItem;
use App\Processes\Business\Planning\BudgetItemProcess;
use App\Processes\Business\Planning\ReviewBudgetProcess;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;


class BudgetReviewController extends Controller
{
    /**
     * @var ReviewBudgetProcess
     */
    private $budgetProcess;

    /**
     * @var BudgetItemProcess
     */
    private $budgetItemProcess;

    /**
     * Constructor de BudgetReviewController.
     *
     * @param ReviewBudgetProcess $budgetProcess
     * @param BudgetItemProcess $budgetItemProcess
     */
    public function __construct(ReviewBudgetProcess $budgetProcess, BudgetItemProcess $budgetItemProcess)
    {
        $this->budgetProcess = $budgetProcess;
        $this->budgetItemProcess = $budgetItemProcess;
    }

    /**
     * Llamada al proceso para mostrar lista de partidas presupuestarias.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response['view'] = view('business.planning.budget_review.index',
                $this->budgetProcess->index())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de partidas presupuestarias.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function data(Request $request)
    {
        try {
            return $this->budgetProcess->data($request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Retorna el formulario para editar una partida presupuestaria.
     *
     * @param BudgetItem $budgetItem
     *
     * @return JsonResponse
     */
    public function edit(BudgetItem $budgetItem)
    {
        try {
            $budgetItem->load([
                'activityProjectFiscalYear.component.project.subprogram.parent',
                'activityProjectFiscalYear.component.project.executingUnit',
                'activityProjectFiscalYear.area',
                'operationalActivity.subprogram.parent.area',
                'operationalActivity.executingUnit'
            ]);
            $response['modal'] = view('business.planning.budget_review.update',
                array_merge([
                    'budgetItem' => $budgetItem,
                ], $this->budgetItemProcess->classifiers())
            )->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualiza una partida presupuestaria
     *
     * @param Request $request
     * @param BudgetItem $budgetItem
     *
     * @return JsonResponse
     */
    public function update(Request $request, BudgetItem $budgetItem)
    {
        try {
            $this->budgetItemProcess->update($request, $budgetItem->id,
                $budgetItem->activityProjectFiscalYear ? BudgetItem::ACTIVITY_TYPE_PROJECT : BudgetItem::ACTIVITY_TYPE_OPERATIONAL);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('budget_item.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Cambia el estado a revisado de todas las partidas seleccionadas
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bulkApprove(Request $request): JsonResponse
    {
        try {
            $response = $this->budgetProcess->bulkChange($request->ids, BudgetItem::STATUS_REVIEWED);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Exporta el reporte poa en excel
     *
     * @param Request $request
     *
     * @return BinaryFileResponse
     * @throws Exception
     */
    public function export(Request $request)
    {
        $data = $this->budgetProcess->all($request->all());

        $view = view('business.planning.budget_review.export', array_merge(['rows' => $data[0]], ['departmentName' => $data[1]]));

        return Excel::download(new DefaultReportExport($view), trans('reports.poa.export_xls') . '.xlsx');

    }
}
