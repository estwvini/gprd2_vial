<?php

namespace App\Http\Controllers\Business\Reports;

use App\Http\Controllers\Controller;
use App\Processes\Business\Reports\ExecutionReportsProcess;
use App\Processes\Configuration\SettingProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;
use PDOException;
use Exception;

/**
 * Clase ExecutionReportsController
 * @package App\Http\Controllers\Business\Reports
 */
class ExecutionReportsController extends Controller
{
    /**
     * @var ExecutionReportsProcess
     */
    protected $executionReportsProcess;

    /**
     * @var SettingProcess
     */
    protected $settingProcess;

    /**
     * Constructor de ExecutionReportsController.
     *
     * @param ExecutionReportsProcess $executionReportsProcess
     * @param SettingProcess $settingProcess
     */
    public function __construct(
        ExecutionReportsProcess $executionReportsProcess,
        SettingProcess $settingProcess
    )
    {
        $this->executionReportsProcess = $executionReportsProcess;
        $this->settingProcess = $settingProcess;
    }

    /**
     * Mostrar vista del reporte de avance físico.
     *
     * @return JsonResponse
     */
    public function physicalAdvanceIndex()
    {
        try {
            $response['view'] = view('business.reports.execution.physical_advance_index',
                $this->executionReportsProcess->physicalAdvanceIndex()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar la información del reporte de avance físico.
     *
     * @param Request $request
     * 
     * @return string
     */
    public function physicalAdvanceReport(Request $request)
    {
        try {
            return $this->executionReportsProcess->physicalAdvanceData($request['fiscalYearId']);
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra reporte de Ingresos y Gastos por Fuente de Financiamiento
     *
     * @return JsonResponse
     */
    public function incomesExpensesBySourceIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.income_expense_by_source.income_expense_by_source',
                $this->executionReportsProcess->incomesExpensesBySourceData()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
