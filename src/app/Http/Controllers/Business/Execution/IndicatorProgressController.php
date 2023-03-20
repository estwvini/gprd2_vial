<?php

namespace App\Http\Controllers\Business\Execution;

use App\Http\Controllers\Controller;
use App\Processes\Business\Execution\IndicatorProgressProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase IndicatorProgressController
 * @package App\Http\Controllers\Business\Execution
 */
class IndicatorProgressController extends Controller
{

    /**
     * @var IndicatorProgressProcess
     */
    protected $indicatorProgressProcess;

    /**
     * Constructor de IndicatorProgressController.
     *
     * @param IndicatorProgressProcess $indicatorProgressProcess
     */
    public function __construct(IndicatorProgressProcess $indicatorProgressProcess)
    {
        $this->indicatorProgressProcess = $indicatorProgressProcess;
    }

    /**
     * Muestra pantalla de indicadores de objetivos operativos
     *
     * @return JsonResponse
     */
    public function operationalGoals()
    {
        try {
            $response['view'] = view('business.execution.indicators.operationalGoals',
                $this->indicatorProgressProcess->operationalGoals()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga tabla con información de indicadores de objetivos operativos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function operationalGoalsData(Request $request)
    {
        try {
            $response['view'] = view('business.execution.indicators.loadTable',
                $this->indicatorProgressProcess->operationalGoalsData($request)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra pantalla de indicadores de pdot
     *
     * @return JsonResponse
     */
    public function pdot()
    {
        try {
            $response['view'] = view('business.execution.indicators.pdot',
                $this->indicatorProgressProcess->pdot()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra pantalla de indicadores de pei
     *
     * @return JsonResponse
     */
    public function pei()
    {
        try {
            $response['view'] = view('business.execution.indicators.pei',
                $this->indicatorProgressProcess->pei()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra pantalla de indicadores de planes sectoriales
     *
     * @return JsonResponse
     */
    public function sectoral()
    {
        try {
            $response['view'] = view('business.execution.indicators.sectoral',
                $this->indicatorProgressProcess->sectoral()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Obtiene los años diponibles para un plan sectorial
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function sectoralGetYears(int $id)
    {
        try {
            $response = $this->indicatorProgressProcess->sectoralGetYears($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga tabla con información de indicadores de planes
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function planData(Request $request)
    {
        try {
            $response['view'] = view('business.execution.indicators.loadTable',
                $this->indicatorProgressProcess->planData($request)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra pantalla de indicadores de proyectos
     *
     * @return JsonResponse
     */
    public function projects()
    {
        try {
            $response['view'] = view('business.execution.indicators.projects',
                $this->indicatorProgressProcess->projects()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga tabla con información de indicadores de proyectos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function projectsData(Request $request)
    {
        try {
            $response['view'] = view('business.execution.indicators.loadTable',
                $this->indicatorProgressProcess->projectsData($request)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra pantalla de indicadores de componentes
     *
     * @return JsonResponse
     */
    public function components()
    {
        try {
            $response['view'] = view('business.execution.indicators.components',
                $this->indicatorProgressProcess->components()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga tabla con información de indicadores de componentes
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function componentsData(Request $request)
    {
        try {
            $response['view'] = view('business.execution.indicators.loadTable',
                $this->indicatorProgressProcess->componentsData($request)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza un indicador completo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateIndicator(Request $request)
    {
        try {
            $response = $this->indicatorProgressProcess->updateIndicator($request->items);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar detalles del indicador por id.
     *
     * @param int $id
     * @param string $indicatorType
     *
     * @return JsonResponse
     */
    public function showIndicator(int $id, string $indicatorType)
    {
        try {
            $response['modal'] = view('business.execution.indicators.show', $this->indicatorProgressProcess->showIndicator($id, $indicatorType))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
