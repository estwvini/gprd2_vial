<?php

namespace App\Http\Controllers\Business\Reports;

use App\Http\Controllers\Controller;
use App\Processes\Business\Reports\DashboardProcess;
use App\Processes\Business\Reports\PlanningReportsProcess;
use App\Processes\Business\Reports\TrackingReportsProcess;
use App\Processes\Business\Tracking\ProjectTrackingProcess;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * Clase DashboardController
 * @package App\Http\Controllers\Business\Reports
 */
class DashboardController extends Controller
{

    /**
     * @var DashboardProcess
     */
    private $dashboardProcess;

    /**
     * @var ProjectTrackingProcess
     */
    protected $projectTrackingProcess;

    /**
     * @var PlanningReportsProcess
     */
    protected $planningReportsProcess;

    /**
     * Constructor de PlanningReportsController.
     *
     * @param DashboardProcess $dashboardProcess
     */

    public function __construct(
        DashboardProcess $dashboardProcess,
        TrackingReportsProcess $trackingReportsProcess,
        ProjectTrackingProcess $projectTrackingProcess,
        PlanningReportsProcess $planningReportsProcess
    ) {
        $this->dashboardProcess = $dashboardProcess;
        $this->trackingReportsProcess = $trackingReportsProcess;
        $this->projectTrackingProcess = $projectTrackingProcess;
        $this->planningReportsProcess = $planningReportsProcess;
    }

    /**
     * @var TrackingReportsProcess
     */
    private $trackingReportsProcess;

    /**
     * Detalles de ingresos
     *
     * @param int $type
     *
     * @return JsonResponse
     */
    public function detailsBudget(int $type)
    {
        try {
            $response['view'] = view('dashboard.planning.components.budget.details', $this->dashboardProcess->detailsBudget($type))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Retorna data en formato JSON para gráfica de presupuesto por fuente de financiamiento
     *
     * @param int $type
     *
     * @param string $category
     *
     * @return JsonResponse
     */
    public function budgetByCategory(int $type, string $category)
    {
        try {
            $result = $this->dashboardProcess->budgetByCategory($type, $category);
        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para gráfica de ejecución presupuesto mensual
     *
     * @return JsonResponse
     */
    public function budgetMonthlyExecution()
    {
        try {
            $result = $this->dashboardProcess->budgetMonthlyExecution();
        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para gráfica de estados de actividad
     *
     * @return JsonResponse
     */
    public function adminActByStatus()
    {
        try {
            $result = $this->dashboardProcess->adminActByStatus();

        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para gráfica de prioridad de actividad
     *
     * @return JsonResponse
     */
    public function adminActByPriority()
    {
        try {
            $result = $this->dashboardProcess->adminActByPriority();

        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para gráfica de actividades por unidad responsable
     *
     * @return JsonResponse
     */
    public function adminActByResponsibleUnit()
    {
        try {
            $result = $this->dashboardProcess->adminActByResponsibleUnit();

        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Detalles de proyectos
     *
     * @param int $type
     *
     * @return JsonResponse
     */
    public function detailsProjects()
    {
        try {
            $rss = [
                'assigned' => 0,
                'reform' => 0,
                'encoded' => 0,
                'engaged'=>0,
                'accrued'=>0
            ];
            $data = $this->planningReportsProcess->budgetCardDataDashboard();
            foreach ($data as $project) {
                if (str_contains($project->cuenta, '999')) {
                    $rss['assigned'] += 0;
                    $rss['reform'] += 0;
                    $rss['encoded'] += 0;
                    $rss['engaged'] += 0;
                    $rss['accrued'] += 0;

                } else {
                    $rss['assigned'] += $project->asig_ini;
                    $rss['reform'] += $project->reformas;
                    $rss['encoded'] += $project->codificado;
                    $rss['engaged'] +=  $project->comprometido;
                    $rss['accrued'] +=  $project->devengado;
                }
            }
            $response['view'] = view('dashboard.planning.components.projects.details', $rss)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Retorna data en formato JSON para gráfica de ejecución presupuesto mensual e pryectos
     *
     * @return JsonResponse
     */
    public function projectMonthlyExecution()
    {
        $result = [];
        try {
            $data = $this->projectTrackingProcess->projectsDashboard();
            $month = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            foreach ($month as $index => $m){
                $result[] = [
                    'month' => $m,
                    'accrued' => $data['budgetMonthly']['accrued'][$index]
                ];
            }
        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para gráfica de avance fisico y avance presupuestario para grafico
     *
     * @return JsonResponse
     */
    public function projectByCategory()
    {
        try {
            $data = $this->trackingReportsProcess->progressDashboardProject();
            $info = [];
            $advance = array();
            foreach ($data['projectFiscalYears'] as $project) {
                $info['category'] = strlen($project->project_name) > 30 ? mb_substr($project->project_name, 0, 30) : $project->project_name;
                $info['progress'] = number_format($project->getProgress(), 2);
                $info['budget_percent'] = number_format($project->budget_percent, 2);
                array_push($advance, $info);
            }
            $result = $advance;

        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }
}
