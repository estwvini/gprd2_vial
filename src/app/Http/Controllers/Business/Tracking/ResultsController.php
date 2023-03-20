<?php

namespace App\Http\Controllers\Business\Tracking;

use App\Http\Controllers\Controller;
use App\Models\Business\Plan;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Processes\Business\Planning\PlanIndicatorProcess;
use App\Processes\Business\Execution\IndicatorProgressProcess;
use App\Processes\Business\Tracking\ResultsProcess;
use App\Repositories\Repository\Admin\ThresholdRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ResultsController
 * @package App\Http\Controllers\Business\Tracking
 */
class ResultsController extends Controller
{

    /**
     * @var IndicatorProgressProcess
     */
    protected $indicatorProgressProcess;

    /**
     * @var PlanElementProcess
     */
    protected $planElementProcess;

    /**
     * @var PlanIndicatorRepository
     */
    protected $planIndicatorRepository;

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * @var ThresholdRepository
     */
    protected $thresholdRepository;

    /**
     * @var ThresholdRepository
     */
    protected $planIndicatorProcess;

    /**
     * @var ResultsProcess
     */
    private $resultsProcess;

    /**
     * Constructor de ResultsController.
     *
     * @param PlanIndicatorRepository $planIndicatorRepository
     * @param PlanElementRepository $planElementRepository
     * @param ThresholdRepository $thresholdRepository
     * @param IndicatorProgressProcess $indicatorProgressProcess
     * @param PlanElementProcess $planElementProcess
     * @param PlanIndicatorProcess $planIndicatorProcess
     * @param ResultsProcess $resultsProcess
     */
    public function __construct(
        PlanIndicatorRepository $planIndicatorRepository,
        PlanElementRepository $planElementRepository,
        ThresholdRepository $thresholdRepository,
        IndicatorProgressProcess $indicatorProgressProcess,
        PlanElementProcess $planElementProcess,
        PlanIndicatorProcess $planIndicatorProcess,
        ResultsProcess $resultsProcess
    ) {
        $this->planIndicatorRepository = $planIndicatorRepository;
        $this->planElementRepository = $planElementRepository;
        $this->thresholdRepository = $thresholdRepository;
        $this->indicatorProgressProcess = $indicatorProgressProcess;
        $this->planElementProcess = $planElementProcess;
        $this->planIndicatorProcess = $planIndicatorProcess;
        $this->resultsProcess = $resultsProcess;
    }

    /**
     * Desplegar lista de indicadores PEI por año.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function indexPEI(Request $request)
    {
        try {
            $params = $this->resultsProcess->indexPEI($request);
            $response['view'] = view('business.tracking.results.pei.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Desplegar lista de indicadores PDOT por año.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function indexPDOT(Request $request)
    {
        try {
            $params = $this->resultsProcess->indexPDOT($request);
            $response['view'] = view('business.tracking.results.pdot.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Desplegar avances por indicadores PEI.
     *
     * @param int $id
     * @param string $year
     *
     * @return JsonResponse
     */
    public function indicatorPEI(int $id, string $year)
    {
        try {
            $params = $this->resultsProcess->indicatorsPEI($id, $year);
            $response['view'] = view('business.tracking.indicators_layout', $params)->render();
        } catch
        (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Desplegar avances por indicadores PDOT.
     *
     * @param int $id
     * @param string $year
     *
     * @return JsonResponse
     */
    public function indicatorPDOT(int $id, string $year)
    {
        try {
            $params = $this->resultsProcess->indicatorsPDOT($id, $year);
            $response['view'] = view('business.tracking.indicators_layout', $params)->render();
        } catch
        (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

}
