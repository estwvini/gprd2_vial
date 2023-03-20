<?php

namespace App\Http\Controllers\Business\Reports;

use App\Exports\DefaultReportExport;
use App\Exports\LotaipExport;
use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Business\Plan;
use App\Models\Business\Tracking\Proforma;
use App\Processes\Business\Reports\PlanningReportsProcess;
use App\Processes\Configuration\SettingProcess;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

/**
 * Clase PlanningReportsController
 *
 * @package App\Http\Controllers\Business\Reports
 */
class PlanningReportsController extends Controller
{
    /**
     * @var PlanningReportsProcess
     */
    protected $planningReportsProcess;

    /**
     * @var SettingProcess
     */
    protected $settingProcess;

    /**
     * Constructor de PlanningReportsController.
     *
     * @param PlanningReportsProcess $planningReportsProcess
     * @param SettingProcess $settingProcess
     */
    public function __construct(
        PlanningReportsProcess $planningReportsProcess,
        SettingProcess $settingProcess
    )
    {
        $this->planningReportsProcess = $planningReportsProcess;
        $this->settingProcess = $settingProcess;
    }

    /**
     * Mostrar vista de listado de reporte PPI.
     *
     * @return JsonResponse
     */
    public function ppiReport()
    {
        try {
            $response['view'] = view('business.reports.planning.ppi', $this->planningReportsProcess->ppiReport())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte PPI.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function ppiData(Request $request)
    {
        try {
            return $this->planningReportsProcess->ppiData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar vista de listado de reporte PND y PDOT.
     *
     * @return JsonResponse
     */
    public function pndAndpdotReport()
    {
        try {
            $response['view'] = view('business.reports.planning.show_plan_links', array_merge(['urlExport' => 'export.index.pndandpdot.reports', 'nameReport' => trans('reports.labels.reportPDOTandPND')],
                $this->planningReportsProcess->makeMatrixPNDandPDOT()))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de listado de reporte PND y PS.
     *
     * @return JsonResponse
     */
    public function pndAndpsReport()
    {
        try {
            $response['view'] = view('business.reports.planning.show_plan_links', $this->planningReportsProcess->makeMatrixPNDandPS())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de listado de reporte PEI y PDOT
     *
     * @return JsonResponse
     */
    public function peiAndpdotReport()
    {
        try {
            $response['view'] = view('business.reports.planning.show_plan_links', array_merge(['urlExport' => 'export.index.pdotandpei.reports', 'nameReport' => trans('reports.labels.reportPEIandPDOT')],
                $this->planningReportsProcess->makeMatrixPEIandPDOT()))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Exporta el reporte poa en excel
     *
     * @return Excel|BinaryFileResponse
     * @throws Throwable
     */
    public function peiAndpdotReportExportXls()
    {
        $view = view('business.reports.planning.show_plan_links_export', array_merge(["nameReport" => trans('reports.labels.reportPEIandPDOT')], $this->planningReportsProcess->makeMatrixPEIandPDOT()));
        return Excel::download(new DefaultReportExport($view), trans('reports.labels.reportPEIandPDOT') . '.xlsx');
    }

    /**
     * Exporta el reporte poa en excel
     *
     * @return Excel|BinaryFileResponse
     * @throws Throwable
     */
    public function pndAndPDOTReportExportXls()
    {
        $view = view('business.reports.planning.show_plan_links_export', array_merge(["nameReport" => trans('reports.labels.reportPDOTandPND')],
            $this->planningReportsProcess->makeMatrixPNDandPDOT()));
        return Excel::download(new DefaultReportExport($view), trans('reports.labels.reportPDOTandPND') . '.xlsx');
    }

    /**
     * Carga vista de todas las articulaciones del plan
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function showPlanLinks(int $id)
    {
        try {
            $response = $this->linkProcess->showPlanLinks($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de listado de reporte PPI.
     *
     * @return JsonResponse
     */
    public function reports()
    {
        try {
            $response['view'] = view('business.reports.planning.ppi')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de reporte POA
     *
     * @return JsonResponse
     */
    public function poaReport()
    {
        try {
            $response['view'] = view('business.reports.planning.poa',
                array_merge(['option' => Plan::HAS_NOT_VIEW], $this->planningReportsProcess->poaReportIndex())
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Retorna una lista de proyectos por unidad ejecutora
     *
     * @param string $executingUnitId
     *
     * @return JsonResponse
     */
    public function loadProjects(string $executingUnitId)
    {
        try {
            return response()->json($this->planningReportsProcess->projectsByExecutingUnit($executingUnitId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar vista de reporte POA
     *
     * @return JsonResponse
     */
    public function poaReportView()
    {
        try {
            $response['view'] = view('business.reports.planning.poa',
                array_merge(['option' => Plan::HAS_VIEW], $this->planningReportsProcess->poaReportIndex())
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte POA.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function poaData(Request $request)
    {
        try {
            return $this->planningReportsProcess->poaReport($request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el reporte poa en excel
     *
     * @param Request $request
     *
     * @return Excel|BinaryFileResponse
     * @throws Exception
     */
    public function poaExportXls(Request $request)
    {
        $data = $this->planningReportsProcess->poaExportXls($request['filters']);

        $view = view('business.reports.planning.poa_table', ['rows' => $data]);

        return Excel::download(new DefaultReportExport($view), trans('reports.poa.export_xls') . '.xlsx');
    }

    /**
     * Mostrar vista de reporte PAC
     *
     * @return JsonResponse
     */
    public function pacReport()
    {
        try {
            $params = $this->planningReportsProcess->pacReportView();
            $params['option'] = Plan::HAS_NOT_VIEW;
            $response['view'] = view('business.reports.planning.pac.pac', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de reporte PAC
     *
     * @return JsonResponse
     */
    public function pacReportView()
    {
        try {
            $response['view'] = view('business.reports.planning.pac.pac', $this->planningReportsProcess->pacReportView())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte PAC.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function pacData(Request $request)
    {
        try {
            return $this->planningReportsProcess->pacReport($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el reporte en excel
     *
     * @param int $fiscalYearId
     *
     * @return Excel|BinaryFileResponse
     * @throws Throwable
     */
    public function pacExportXls(int $fiscalYearId)
    {
        $data = $this->planningReportsProcess->pacExportXls($fiscalYearId);

        $view = view('business.reports.planning.pac.pac_table', $data);

        return Excel::download(new DefaultReportExport($view), trans('reports.pac.title') . '.xlsx');
    }

    /**
     * Mostrar vista de reporte Resumen ejecutivo de proyectos priorizados.
     *
     * @return JsonResponse
     */
    public function executiveSummaryView()
    {
        try {
            $response['view'] = view('business.reports.planning.executive_summary',
                $this->planningReportsProcess->executiveSummary()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte Resumen ejecutivo de proyectos priorizados.
     *
     * @param int $fiscalYearId
     *
     * @return mixed|string
     */
    public function executiveSummaryData(int $fiscalYearId)
    {
        try {
            return $this->planningReportsProcess->executiveSummaryPriorizedProjects($fiscalYearId);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cargar información del reporte Resumen ejecutivo de proyectos priorizados.
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function dataExecutiveSummaryExportView(int $fiscalYearId)
    {
        try {
            $data['projectFiscalYears'] = $this->planningReportsProcess->executiveSummaryPriorizedProjectsExport($fiscalYearId);
            $pdf = PDF::loadView('business/reports/planning/executive_summary_partial', $data);

            return $pdf->download(trans('reports.executive_summary.export') . '.pdf');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar vista de listado de reporte PEI vinculado a estructura programática.
     *
     * @return JsonResponse
     */
    public function peiStructureIndex()
    {
        try {
            $response['view'] = view('business.reports.planning.pei_structure.index',
                $this->planningReportsProcess->peiStructureIndex()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar la información del reporte de PEI vinculado a estructura programática.
     *
     * @param int $fiscalYearId
     *
     * @return JsonResponse
     */
    public function peiStructureReport(int $fiscalYearId)
    {
        try {
            $response['view'] = view('business.reports.planning.pei_structure.table',
                $this->planningReportsProcess->createPEIStructureMatrix($fiscalYearId)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Exporta el reporte del PEI vinculado a la estructura programática en excel
     *
     * @param int $fiscalYearId
     *
     * @return Excel|BinaryFileResponse
     * @throws Throwable
     */
    public function peiStructureExport(int $fiscalYearId)
    {
        $rows = $this->planningReportsProcess->createPEIStructureMatrix($fiscalYearId);
        $gad = $this->settingProcess->gad();
        $view = view('business.reports.planning.pei_structure.table', $rows);

        return Excel::download(new ReportExport($view, $gad, trans('reports.pei_structure.title')), 'pei_prog_estruc.xlsx');
    }

    /**
     * Mostrar vista de reporte (Proforma Presupuestaria por año).
     *
     * @return JsonResponse
     */
    public function budgetAdjustmentView()
    {
        try {
            $response['view'] = view('business.reports.planning.budget_adjustment',
                $this->planningReportsProcess->executiveSummary()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte (Proforma Presupuestaria por año).
     *
     * @param int $fiscalYearId
     *
     * @return mixed|string
     */
    public function budgetAdjustmentData(int $fiscalYearId)
    {
        try {
            return $this->planningReportsProcess->budgetAdjustmentData($fiscalYearId);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar vista de listado de reporte de matriz de planes sectoriales.
     *
     * @return JsonResponse
     */
    public function sectorialPlansIndex()
    {
        try {
            $response['view'] = view('business.reports.planning.sectorial_plans_matrix.index',
                $this->planningReportsProcess->sectorialPlansIndex()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Exporta el reporte del PEI vinculado a la estructura programática en excel
     *
     * @return Excel|BinaryFileResponse
     * @throws Throwable
     */
    public function sectorialPlansExport()
    {
        $rows = $this->planningReportsProcess->sectorialPlansIndex();
        $gad = $this->settingProcess->gad();
        $view = view('business.reports.planning.sectorial_plans_matrix.table', $rows);

        return Excel::download(new ReportExport($view, $gad, trans('reports.sectorial_plans.title')), 'planes_sect.xlsx');
    }

    /**
     * Muestra la página principal del reporte de banco de proyectos
     *
     * @return JsonResponse
     */
    public function projectsRepositoryIndex()
    {
        try {
            $response['view'] = view('business.reports.planning.projects_repository.projects_repository',
                $this->planningReportsProcess->projectsRepositoryIndex()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param Request $request
     *
     * @return array|string
     */
    public function projectsRepositoryData(Request $request)
    {
        try {
            return $this->planningReportsProcess->projectsRepositoryData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mustra reporte de Cédula Presupuestaria
     *
     * @return JsonResponse
     */
    public function budgetCardIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.budget_card.budget_card',
                $this->planningReportsProcess->budgetCardIndex()
            )->render();
        } catch (PDOException $e) {
            datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
            $response['message'] = [
                'type' => 'warning',
                'text' => trans('app.messages.exceptions.sfgprov_not_available')
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Obtiene informaciín para reporte de Cédula Presupuestaria
     *
     * @param Request $request
     *
     * @return string
     */
    public function budgetCardData(Request $request)
    {
        try {
            return $this->planningReportsProcess->budgetCardData($request->all());
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra reporte de movimientos por partidas presupuestarias
     *
     * @param int $year
     * @param string $account
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function budgetItemMovements(int $year, string $account)
    {
        try {
            $response['view'] = view('business.reports.tracking.budget_card.item_movements',
                $this->planningReportsProcess->getBudgetItemByAccount($year, $account)
            )->render();
        } catch (PDOException $e) {
            $response['message'] = [
                'type' => 'warning',
                'text' => trans('app.messages.exceptions.sfgprov_not_available')
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Obtiene informaciín de movimientos por partida presupuestaria
     *
     * @param Request $request
     *
     * @return string
     */
    public function budgetItemMovementsData(Request $request)
    {
        try {
            return $this->planningReportsProcess->budgetItemMovementsData($request->all()['year'], $request->all()['account']);
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exportar reporte de Cédula Presupuestaria
     *
     * @param Request $request
     *
     * @return BinaryFileResponse
     */
    public function budgetCardExport(Request $request)
    {
        $data = $request->all();
        $items = $this->planningReportsProcess->budgetCardDataExport($data);
        $reportTitle = trans('reports.budget_card.report_title',
                ['type' => $data['type'] == Proforma::TYPE_EXPENSE ? trans('reports.budget_card.type_expense') : trans('reports.budget_card.type_income')]) . ' - ' . $data['year'];

        $view = view('business.reports.tracking.budget_card.budget_card_table', ['rows' => $items, 'reportTitle' => $reportTitle, 'date' => $data['date'], 'levelDescription' => $data['levelDescription']]);

        return Excel::download(new DefaultReportExport($view), trans('reports.budget_card.report_file_name'));
    }

    /**
     * Llamada al proceso para buscar los niveles de las estructuras de Ingreso ó Gasto
     *
     * @param int $year
     * @param int $type
     *
     * @return JsonResponse
     */
    public function structureLevels(int $year, int $type)
    {
        try {
            return response()->json($this->planningReportsProcess->levels($year, $type));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Exporta el reporte en excel
     *
     * @param Request $request
     *
     * @return Excel|BinaryFileResponse
     * @throws Exception
     */
    public function projectsRepositoryExport(Request $request)
    {
        $data = $this->planningReportsProcess->projectsRepositoryExport($request);
        $gad = $this->settingProcess->gad();
        $reportTitle = trans('reports.projects_repository.title');

        $view = view('business.reports.planning.projects_repository.projects_repository_table', ['rows' => $data['rows']]);

        return Excel::download(new ReportExport($view, $gad, $reportTitle), trans('reports.projects_repository.title') . '.xlsx');
    }

    /**
     * Mostrar vista de listado de reporte de acuerdo por resultados.
     *
     * @return JsonResponse
     */
    public function agreementForResultsIndex()
    {
        try {
            $response['view'] = view('business.reports.planning.agreement_for_results.index',
                $this->planningReportsProcess->agreementForResultsIndex()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Obtiene los datos necesarios del acuerdo por resultados.
     *
     * @param Request $request
     *
     * @return array|string
     */
    public function agreementForResultsData(Request $request)
    {
        try {
            return $this->planningReportsProcess->agreementForResultsData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llama al proceso para buscar los funcionarios a mostrar.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function servantSearch(Request $request)
    {
        try {
            return response()->json($this->planningReportsProcess->servantSearch($request->all()));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Exporta a PDF.
     *
     * @param Request $request
     *
     * @return string
     */
    public function agreementForResultsExport(Request $request)
    {
        try {
            $data = $this->planningReportsProcess->agreementForeResultsExport($request);
            $pdf = PDF::loadView('business/reports/planning/agreement_for_results/table', $data);

            return $pdf->download(trans('reports.agreement_for_results.export') . '.pdf');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar vista de listado de reporte PPI.
     *
     * @return JsonResponse
     */
    public function annualBudgetPlanningReport()
    {
        try {
            $response['view'] = view('business.reports.planning.annual_budget_planning.annual_budget_planning',
                $this->planningReportsProcess->annualBudgetPlanningReport())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte PPI.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function annualBudgetPlanningData(Request $request)
    {
        try {
            return $this->planningReportsProcess->annualBudgetPlanningData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el reporte en excel
     *
     * @param int $fiscalYearId
     * @param int|null $departmentId
     *
     * @return Excel|BinaryFileResponse
     * @throws Exception
     */
    public function annualBudgetPlanningExport(int $fiscalYearId, int $departmentId = null)
    {
        $data = $this->planningReportsProcess->annualBudgetPlanningExport($fiscalYearId, $departmentId);
        $gad = $this->settingProcess->gad();
        $reportTitle = trans('reports.annual_budget_planning.title') . ' - ' . $data['year'];

        $view = view('business.reports.planning.annual_budget_planning.annual_budget_planning_table', $data);

        return Excel::download(new ReportExport($view, $gad, $reportTitle), trans('reports.annual_budget_planning.title') . '.xlsx');
    }

    /**
     * Mostrar vista de listado de reporte de ejecucíon de actividades por trimestres.
     *
     * @return JsonResponse
     */
    public function activitiesQuarterlyExecutionReport()
    {
        try {
            $response['view'] = view('business.reports.planning.activities_quarterly_execution', $this->planningReportsProcess->activitiesQuarterlyExecutionReport())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte de ejecucíon de actividades por trimestres.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function activitiesQuarterlyExecutionData(Request $request)
    {
        try {
            return $this->planningReportsProcess->activitiesQuarterlyExecutionData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Obtiene lista de proyectos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function projectSearch(Request $request)
    {
        try {
            $response = $this->planningReportsProcess->projectSearch($request);
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
            $response['view'] = view('business.reports.planning.income_expense_by_source.income_expense_by_source',
                $this->planningReportsProcess->incomesExpensesBySourceIndex()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de Ingresos y Gastos por Fuente de Financiamiento
     *
     * @param int $fiscalYearId
     *
     * @return JsonResponse
     */
    public function incomesExpensesBySourceData(int $fiscalYearId)
    {
        try {
            $data = $this->planningReportsProcess->incomesExpensesBySourceData($fiscalYearId);
            $response = [
                'view' => view('business.reports.planning.income_expense_by_source.income_expense_table',
                    ['sources' => $data[0]]
                )->render(),
                'summary' => $data[1]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra reporte de la LOTAIP
     *
     * @return JsonResponse
     */
    public function lotaipIndex()
    {
        try {
            $response['view'] = view('business.reports.planning.lotaip.lotaip',
                $this->planningReportsProcess->lotaipIndex()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de la LOTAIAP
     *
     * @param int $fiscalYearId
     *
     * @return JsonResponse
     */
    public function lotaipData(int $fiscalYearId)
    {
        try {
            $data = $this->planningReportsProcess->lotaipData($fiscalYearId);

            $response = [
                'view' => view('business.reports.planning.lotaip.lotaip_table',
                    ['rows' => $data]
                )->render(),
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Exportar reporte de la LOTAIP
     *
     * @param int $fiscalYearId
     *
     * @return BinaryFileResponse
     */
    public function lotaipDataExport(int $fiscalYearId)
    {
        $data = $this->planningReportsProcess->lotaipData($fiscalYearId);

        $view = view('business.reports.planning.lotaip.lotaip_table', ['rows' => $data]);

        return Excel::download(new DefaultReportExport($view), 'lotaip.xlsx');
    }

    /**
     * Muestra reporte de Proyectos y Actividades POA
     *
     * @return JsonResponse
     */
    public function projectActivityPOAIndex()
    {
        try {
            $response['view'] = view('business.reports.planning.project_activity_poa.index', $this->planningReportsProcess->projectActivityIndex())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra tabla de reporte de Proyectos y Actividades POA
     *
     * @param int $executingUnitId
     *
     * @return JsonResponse
     */
    public function projectActivityPOAIndexData(int $executingUnitId)
    {
        try {
            $response['view'] = view('business.reports.planning.project_activity_poa.objectives', $this->planningReportsProcess->projectActivityData($executingUnitId))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mustra reporte de Cédula Presupuestaria de Gastos
     *
     * @return JsonResponse
     */
    public function budgetCardExpensesIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.budget_card_expenses.budget_card_expenses_index',
                $this->planningReportsProcess->budgetCardExpensesIndex()
            )->render();
        } catch (PDOException $e) {
            datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
            $response['message'] = [
                'type' => 'warning',
                'text' => trans('app.messages.exceptions.sfgprov_not_available')
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Obtiene información para reporte de Cédula Presupuestaria de Gastos
     *
     * @param Request $request
     *
     * @return string
     */
    public function budgetCardExpensesData(Request $request)
    {
        try {
            return $this->planningReportsProcess->budgetCardExpensesData($request->all());
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

}
