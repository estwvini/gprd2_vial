<?php

namespace App\Http\Controllers\Business\Tracking;

use App\Exports\DefaultReportExport;
use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\ActivityProjectFiscalYearProcess;
use App\Processes\Business\Planning\ProjectProcess;
use App\Processes\Business\Tracking\ProjectTrackingProcess;
use App\Repositories\Repository\Business\ProjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Clase ProjectTrackingController
 * @package App\Http\Controllers\Business\Tracking
 */
class ProjectTrackingController extends Controller
{
    /**
     * @var ProjectTrackingProcess
     */
    protected $projectTrackingProcess;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var ActivityProjectFiscalYearProcess
     */
    private $activityProcess;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * Constructor de ProjectTrackingController.
     *
     * @param ProjectTrackingProcess $projectTrackingProcess
     * @param ProjectProcess $projectProcess
     * @param ActivityProjectFiscalYearProcess $activityProcess
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectTrackingProcess $projectTrackingProcess, ProjectProcess $projectProcess, ActivityProjectFiscalYearProcess $activityProcess, ProjectRepository $projectRepository)
    {
        $this->projectTrackingProcess = $projectTrackingProcess;
        $this->projectProcess = $projectProcess;
        $this->activityProcess = $activityProcess;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Llamada al proceso para mostrar vista de seguimiento de proyectos.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function index()
    {
        try {
            $response['view'] = view('business.tracking.projects.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables.
     *
     * @return JsonResponse
     */
    public function data()
    {
        try {
            return $this->projectTrackingProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar vista de seguimiento físico y presupuestario de proyectos.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function progressIndex(int $id)
    {
        try {
            $params = $this->projectTrackingProcess->progressIndex($id);

            $response['view'] = view('business.tracking.projects.progress', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para obtener información presupuestaria de proyectos
     *
     * @param int $projectFiscalYearId
     *
     * @return JsonResponse
     */
    public function filterBudgetProjects(int $projectFiscalYearId)
    {
        try {
            return response()->json($this->projectTrackingProcess->filterBudgetProjects($projectFiscalYearId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para obtener información presupuestaria por criterios
     *
     * @param string $criteria
     *
     * @return JsonResponse
     */
    public function filterBudgetCriteria(string $criteria)
    {
        try {
            return response()->json($this->projectTrackingProcess->filterBudgetCriteria($criteria));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para obtener información presupuestaria por criterios
     *
     * @param int $projectFiscalYearId
     *
     * @return JsonResponse
     */
    public function filterPhysicalProjects(int $projectFiscalYearId)
    {
        try {
            return response()->json($this->projectTrackingProcess->filterPhysicalProjects($projectFiscalYearId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Muestra la vista de Indicadores de Proyectos.
     *
     * @return JsonResponse
     */
    public function projectIndicatorsIndex()
    {
        try {
            $response['view'] = view('business.tracking.projects.indicators.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llama al proceso para cargar la información del listado de proyectos en ejecución.
     *
     * @return mixed|string
     */
    public function projectIndicatorsData()
    {
        try {
            return $this->projectTrackingProcess->projectIndicatorsData();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra la vista de los indicadores de un proyecto.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function projectIndicatorsShow(Request $request)
    {
        try {
            $params = $this->projectTrackingProcess->projectIndicatorsShow($request['id'], $request['year']);
            $response['view'] = view('business.tracking.projects.indicators.show_indicators', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra la vista de Componentes de Proyectos.
     *
     * @return JsonResponse
     */
    public function projectComponentsIndex()
    {
        try {
            $response['view'] = view('business.tracking.projects.components.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llama al proceso para cargar la información del listado de proyectos en ejecución con componentes.
     *
     * @return mixed|string
     */
    public function projectComponentsData()
    {
        try {
            return $this->projectTrackingProcess->projectComponentsData();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra la vista de los componentes de un proyecto.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function projectComponentsShow(Request $request)
    {
        try {
            $params = $this->projectTrackingProcess->projectComponentsShow($request['id']);
            $response['view'] = view('business.tracking.projects.components.show', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra la vista de los indicadores de un componente.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function projectComponentIndicators(Request $request)
    {
        try {
            $params = $this->projectTrackingProcess->projectComponentIndicators($request['id'], $request['year']);
            $response['view'] = view('business.tracking.indicators_layout', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
