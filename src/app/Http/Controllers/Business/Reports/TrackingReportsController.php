<?php

namespace App\Http\Controllers\Business\Reports;

use App\Exports\DefaultReportExport;
use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Processes\Business\Reports\TrackingReportsProcess;
use App\Processes\Business\Tracking\POATrackingProcess;
use App\Processes\Configuration\SettingProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\Snappy\Facades\SnappyPdf as PDFSnappy;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

/**
 * Clase TrackingReportsController
 *
 * @package App\Http\Controllers\Business\Reports
 */
class TrackingReportsController extends Controller
{
    /**
     * @var TrackingReportsProcess
     */
    private $trackingReportsProcess;

    /**
     * @var POATrackingProcess
     */
    private $POATrackingProcess;

    /**
     * @var SettingProcess
     */
    private $settingProcess;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * Constructor de TrackingReportsController.
     *
     * @param TrackingReportsProcess $trackingReportsProcess
     * @param POATrackingProcess $POATrackingProcess
     * @param SettingProcess $settingProcess
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param DepartmentRepository $departmentRepository
     * @param UserRepository $userRepository
     * @param ProjectRepository $projectRepository
     */
    public function __construct(
        TrackingReportsProcess $trackingReportsProcess,
        POATrackingProcess $POATrackingProcess,
        SettingProcess $settingProcess,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository,
        DepartmentRepository $departmentRepository,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {
        $this->trackingReportsProcess = $trackingReportsProcess;
        $this->POATrackingProcess = $POATrackingProcess;
        $this->settingProcess = $settingProcess;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->departmentRepository = $departmentRepository;
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Mostrar vista de reporte POA
     *
     * @return JsonResponse
     */
    public function poaReport()
    {
        try {
            $response['view'] = view('business.reports.tracking.poa.index',
                $this->trackingReportsProcess->poaReportIndex()
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
            return $this->trackingReportsProcess->poaReport($request->all());
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
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
            return response()->json($this->trackingReportsProcess->projectsByExecutingUnit($executingUnitId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Exporta el reporte de poa a excel.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function poaReportExport(Request $request)
    {
        try {

            $data = $this->trackingReportsProcess->poaReportExport($request);

            $view = view('business.reports.tracking.poa.table', ['rows' => $data['rows']]);

            return Excel::download(new DefaultReportExport($view), trans('reports.poa.export_xls') . '.xlsx');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar lista de departamentos con sus proyectos.
     *
     * @return JsonResponse
     */
    public function poaPhysicalBudget()
    {
        try {
            $params = $this->POATrackingProcess->index();
            $response['view'] = view('business.reports.tracking.poa_physical_budget.poa_physical_budget', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del POA.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function poaPhysicalBudgetData(Request $request)
    {
        try {
            return $this->POATrackingProcess->data($request);
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el reporte en excel
     *
     * @param int $fiscalYearId
     *
     * @param int $executingUnitId
     *
     * @return string
     */
    public function poaPhysicalBudgetExport(int $fiscalYearId, int $executingUnitId)
    {
        try {
            $data = $this->POATrackingProcess->poaPhysicalBudgetExport($fiscalYearId, $executingUnitId);
            $gad = $this->settingProcess->gad();
            if ($executingUnitId != 0) {
                $reportTitle = trans('poa_tracking.labels.POA') . ' - ' . $data['executingUnit'] . ' - ' . $data['year'];
            } else {
                $reportTitle = trans('poa_tracking.labels.POA') . ' - ' . $data['year'];
            }

            $view = view('business.reports.tracking.poa_physical_budget.poa_physical_budget_table', $data);

            return Excel::download(new ReportExport($view, $gad, $reportTitle), trans('poa_tracking.labels.POA') . '.xlsx');
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra reporte de avance de planificación de proyectos
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function executionProjectsIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.execution_projects.index_execution_project',
                $this->trackingReportsProcess->planningExecutionProjectsIndex())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra informe ejecutivo de proyectos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function executionProjectsIndexExport(Request $request)
    {
        try {
            $data = $this->trackingReportsProcess->executionProjectsIndex($request->all());
            $pdf = PDFSnappy::loadView('business/reports/tracking/execution_projects/execution_project', [
                'projectFiscalYears' => $data[0],
                'year' => $data[1],
                'date' => $request->all()['date'] ?? now()->format('d/m/Y')
            ]);

            return $pdf->download(trans('reports.execution_projects.filename'));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Muestra reporte de avance de planificación de proyectos
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function planningExecutionProjectsIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.execution_projects.index_planning_execution_project',
                $this->trackingReportsProcess->planningExecutionProjectsIndex())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra informe ejecutivo de proyectos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function planningExecutionProjectsExport(Request $request)
    {
        try {
            $data = $this->trackingReportsProcess->planningExecutionProjectsIndexExport($request->all());
            $pdf = PDFSnappy::loadView('business/reports/tracking/execution_projects/planning_execution_project', [
                'rows' => $data,
                'date' => $request->all()['date'] ?? now()->format('d/m/Y')
            ]);

            return $pdf->download(trans('reports.planning_execution_projects.filename'));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar vista de reporte de proyectos de arrastre
     *
     * @return JsonResponse
     */
    public function ongoingProjectIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.ongoing.index',
                []
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte de proyectos de arrastre
     *
     * @return mixed|string
     */
    public function ongoingProjectData()
    {
        try {
            return $this->trackingReportsProcess->ongoingProjectDataTable();
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el reporte de proyectos de arrastre en excel
     *
     * @return string
     * @throws Throwable
     */
    public function ongoingProjectExport()
    {
        try {

            $data = $this->trackingReportsProcess->ongoingProjectDataTable('')->getData()->data;
            $gad = $this->settingProcess->gad();
            $reportTitle = trans('reports.ongoing_projects.title');

            $view = view('business.reports.tracking.ongoing.ongoing_table', ['rows' => $data]);

            return Excel::download(new ReportExport($view, $gad, $reportTitle), trans('reports.ongoing_projects.file_name_excel_report'));
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra reporte Comparativo entre planificado y devengado
     *
     * @return JsonResponse
     */
    public function planningAccruedIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.planning_accrued.index', $this->trackingReportsProcess->planningAccruedIndex())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra tabla del reporte Comparativo entre planificado y devengado
     *
     * @param int $executingUnitId
     *
     * @return JsonResponse
     */
    public function planningAccruedData(int $executingUnitId)
    {
        try {
            $response['view'] = view('business.reports.tracking.planning_accrued.projects', $this->trackingReportsProcess->projectActivityData($executingUnitId))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el reporte de Tareas/Hitos
     *
     * @return JsonResponse
     */
    public function taskMilestone()
    {
        try {
            $response['view'] = view('business.reports.tracking.task_milestone.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables para el reporte Tareas/Hitos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function taskMilestoneData(Request $request)
    {
        try {
            $filter = $request->all()['filter'];
            return $this->trackingReportsProcess->taskMilestoneData($filter);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta Tareas/Hitos en un documento Excel
     *
     * @param Request $request
     *
     * @return string|BinaryFileResponse
     */
    public function exportTaskMilestoneData(Request $request)
    {
        try {
            $filter = $request->all()['filter'];
            $data = $this->trackingReportsProcess->taskMilestoneData($filter);
            $gad = $this->settingProcess->gad();
            $reportTitle = trans('reports.task_milestone.title');
            $view = view('business.reports.tracking.task_milestone.task_milestone_table', ['rows' => $data->getData()->data]);
            return Excel::download(new ReportExport($view, $gad, $reportTitle), trans('reports.task_milestone.file_name_excel_report'));
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra el reporte de Plan de Mitigación de Riesgo
     *
     * @return JsonResponse
     */
    public function riskMitigationPlan()
    {
        try {
            $response['view'] = view('business.reports.tracking.risk_mitigation_plan.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables para el reporte Plan de Mitigación de Riesgo
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function riskMitigationPlanData()
    {
        try {
            return $this->trackingReportsProcess->riskMitigationPlanData();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el Plan de Mitigación de Riesgo en un documento Excel
     *
     * @param Request $request
     *
     * @return string|BinaryFileResponse
     */
    public function exportRiskMitigationPlanData()
    {
        try {
            $data = $this->trackingReportsProcess->riskMitigationPlanData();
            $view = view('business.reports.tracking.risk_mitigation_plan.risk_mitigation_plan_table', ['rows' => $data->getData()->data]);
            return Excel::download(new DefaultReportExport($view), trans('reports.task_milestone.file_name_excel_report'));
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra el reporte de Presupuesto Participativo
     *
     * @return JsonResponse
     */
    public function participatoryBudget()
    {
        try {
            $response['view'] = view('business.reports.tracking.participatory_budget.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables para el reporte Presupuesto Participativo
     *
     * @return string
     */
    public function participatoryBudgetData()
    {
        try {
            return $this->trackingReportsProcess->participatoryBudgetData();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el Presupuesto Participativo en un documento Excel
     *
     * @return string|BinaryFileResponse
     */
    public function exportParticipatoryBudgetData()
    {
        try {
            $data = $this->trackingReportsProcess->participatoryBudgetData();
            $view = view('business.reports.tracking.participatory_budget.participatory_budget_table', ['rows' => $data->getData()->data]);
            return Excel::download(new DefaultReportExport($view), trans('reports.participatory_budget.file_name_excel_report'));
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra el reporte de Actividades Administrativas
     *
     * @return JsonResponse
     */
    public function adminActivities()
    {
        try {
            $response['view'] = view('business.reports.tracking.admin_activities.index', $this->trackingReportsProcess->adminActivitiesIndex())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables para el reporte de Actividades Administrativas
     *
     * @param Request $request
     *
     * @return string
     */
    public function adminActivitiesData(Request $request)
    {
        try {
            return $this->trackingReportsProcess->adminActivitiesData($request->all()['filters']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta las actividades administrativas en un documento PDF
     *
     * @param Request $request
     *
     * @return string|BinaryFileResponse
     */
    public function exportAdminActivitiesData(Request $request)
    {
        try {
            $data = $this->trackingReportsProcess->agreementForeResultsExport($request->all()['filters']);
            $pdf = PDF::loadView('business/reports/tracking/admin_activities/admin_activity_table', $data)->setPaper('a4', 'landscape');
            return $pdf->download(trans('reports.admin_activities.export') . '.pdf');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar vista de reporte PAC
     *
     * @return JsonResponse
     */
    public function pacReportIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.pac.pac', $this->trackingReportsProcess->pacReport())->render();
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
            return $this->trackingReportsProcess->pacReportData($request);
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
        $data = $this->trackingReportsProcess->pacExportXls($fiscalYearId);

        $view = view('business.reports.tracking.pac.pac_table', $data);

        return Excel::download(new DefaultReportExport($view), trans('reports.pac.title') . '.xlsx');
    }

    /**
     * Muestra el reporte de Actividades Administrativas
     *
     * @return JsonResponse
     */
    public function adminActivitiesResponsibleUnit()
    {
        try {
            $response['view'] = view('business.reports.tracking.admin_activities_responsible_unit.index',
                $this->trackingReportsProcess->adminActivitiesResponsibleUnit()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el reporte de Avance de proyectos de inversión
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function progressInvestmentProject(Request $request)
    {
        try {
            $response['view'] = view('business.reports.tracking.progress_investment_project.index',
                $this->trackingReportsProcess->progressInvestmentProject($request->all())
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el reporte de Actividades Administrativas  y Presupuesto por Dirección
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function adminActivitiesBudgetResponsibleUnit(Request $request)
    {
        try {
            $response['view'] = view('business.reports.tracking.admin_activities_budget.index',
                $this->trackingReportsProcess->adminActivitiesBudgetResponsibleUnit(false, $request->all())
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el reporte Ejectivo Avance de Proyectos de Inversión
     *
     * @return JsonResponse
     */
    public function executiveProgressProject()
    {
        try {
            $response['view'] = view('business.reports.tracking.executive_progress_projects.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el reporte Ejectivo Avance de Proyectos de Inversión
     *
     * @param Request $request
     *
     * @return string
     */
    public function executiveProgressProjectData(Request $request)
    {
        try {
            return $this->trackingReportsProcess->executiveProgressProject($request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra el reporte Ejectivo Avance Físico y Presupuestario por Dirección
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function executiveProgressUnit(Request $request)
    {
        try {
            $response['view'] = view('business.reports.tracking.executive_progress_unit.index',
                $this->trackingReportsProcess->adminActivitiesBudgetResponsibleUnit(true, $request->all())
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el reporte de Avance de proyectos de inversión de lo ejecutado y lo programado
     *
     * @param Request|null $request
     *
     * @return JsonResponse
     */
    public function progressInvestmentProjectsExecutedProgrammed(Request $request)
    {
        try {

            $response['view'] = view('business.reports.tracking.progress_investment_projects_executed_programmed.index',
                $this->trackingReportsProcess->getExecutionProjectsAdvanceInvestmentProjects(true)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra el reporte de Avance de proyectos de inversión de lo ejecutado y lo programado por fecha
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function progressInvestmentProjectsExecutedProgrammedbyDate(Request $request)
    {
        try {
            $response['view'] = view('business.reports.tracking.progress_investment_projects_executed_programmed.index_by_date',
                $this->trackingReportsProcess->getExecutionProjectsAdvanceInvestmentProjects(false, $request->all())
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra el reporte de Actividades Administrativas y de Proyectos
     *
     * @return JsonResponse
     */
    public function projectAdminActivitiesIndex()
    {
        try {
            $response['view'] = view('business.reports.tracking.admin_activities_and_projects.index',
                array_merge($this->trackingReportsProcess->adminActivitiesIndex(),
                    ['projects' => $this->projectFiscalYearRepository->findAllTraceable($this->fiscalYearRepository->findCurrentFiscalYear())->get()])
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables para el reporte de Actividades Administrativas
     *
     * @param Request $request
     *
     * @return string
     */
    public function reportAdminActivitiesData(Request $request)
    {
        try {
            return $this->trackingReportsProcess->reportAdminActivitiesData($request->all()['filters']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Procesar la respuesta ajax de datatables para el reporte de Actividades de Proyectos
     *
     * @param Request $request
     *
     * @return string
     */
    public function reportProjectActivitiesData(Request $request)
    {
        try {
            return $this->trackingReportsProcess->reportProjectActivitiesData($request->all()['filters']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exportar reporte de Actividades Administrativas y de Proyectos
     *
     * @param Request $request
     *
     * @return BinaryFileResponse
     * @throws Exception
     */
    public function reportProjectActivitiesExport(Request $request)
    {
        $data = $request->all();
        $projects = $this->trackingReportsProcess->reportProjectActivitiesData($data)->getData()->data;
        $activities = $this->trackingReportsProcess->reportAdminActivitiesData($data)->getData()->data;

        $responsibleUnitName = isset($data['responsible_unit_id']) ? $this->departmentRepository->find($data['responsible_unit_id'])->name : '';
        $projectName = isset($data['project_fiscal_year_id']) ? $this->projectFiscalYearRepository->find($data['project_fiscal_year_id'])->project->name : '';
        $userName = isset($data['assigned_user_id']) ? $this->userRepository->find($data['assigned_user_id'])->fullName() : '';

        $view = view('business.reports.tracking.admin_activities_and_projects.report_admin_activity_table', [
            'projects' => $projects,
            'activities' => $activities,
            'responsibleUnit' => $responsibleUnitName,
            'project' => $projectName,
            'responsible' => $userName
        ]);

        return Excel::download(new DefaultReportExport($view), trans('reports.project_admin_activities.title') . '.xlsx');
    }

    /**
     * Exporta reporte de Inidcadores de Proyectos
     *
     * @return string|BinaryFileResponse
     */
    public function projectComponentsIndicatorsExport()
    {
        try {
            $data = $this->projectRepository->getProjectsWithComponentsIndicators();
            $view = view('business.reports.tracking.indicators.table', ['rows' => $data]);
            return Excel::download(new DefaultReportExport($view), trans('components.labels.file_name_excel_report'));
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra el reporte de Actividades Administrativas y de Proyectos
     *
     * @return JsonResponse
     */
    public function reformCertificationIndex()
    {
        try {
            $data = ['projects' => $this->projectFiscalYearRepository->findAllTraceable($this->fiscalYearRepository->findCurrentFiscalYear())->get()];
            $response['view'] = view('business.reports.tracking.reforms_and_certifications.index_reforms_and_certifications', $data)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra reporte de reformas y certificaciones cronograma planificacion presupuestaria
     *
     * @param string $projectId
     *
     * @return BinaryFileResponse
     * @throws Exception
     */
    public function reformCertificationIndexExport(string $projectId)
    {
        $data = $this->trackingReportsProcess->reformCertificationsReport((int)$projectId);
        $view = view('business.reports.tracking.reforms_and_certifications.table', ['rows' => $data]);
        return Excel::download(new DefaultReportExport($view), trans('reports.reforms_and_certifications.Budget_planning_schedule') . '.xlsx');
    }

    /**
     * Muestra reporte de reformas y certificaciones cronograma de actividades
     *
     * @param string $projectId
     *
     * @return BinaryFileResponse
     * @throws Exception
     */
    public function reformCertificationIndexExport2(string $projectId)
    {
        $data = $this->trackingReportsProcess->reformCertificationsReport((int)$projectId);
        $view = view('business.reports.tracking.reforms_and_certifications.table_activities', ['rows' => $data]);
        return Excel::download(new DefaultReportExport($view), trans('reports.reforms_and_certifications.Schedule_of_activities') . '.xlsx');
    }

    /**
     * Obtiene informaciín para reporte dereformas y certificaciones cronograma planfiicacion presupuestaria
     *
     * @param Request $request
     *
     * @return string
     */
    public function reformCertificationData(Request $request)
    {
        try {
            return $this->trackingReportsProcess->reformCertificationData($request->all());
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Obtiene informaciín para reporte dereformas y certificaciones cronograma de actividades
     *
     * @param Request $request
     *
     * @return string
     */
    public function reformCertificationData2(Request $request)
    {
        try {
            return $this->trackingReportsProcess->reformCertificationData2($request->all());
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }
}
