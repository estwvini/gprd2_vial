<?php

namespace App\Http\Controllers\Business\Tracking;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Processes\Business\Tracking\OperationalGoalsTrackingProcess;
use App\Repositories\Repository\Business\PlanElementRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase OperationalGoalsTrackingController
 * @package App\Http\Controllers\Business\Tracking
 */
class OperationalGoalsTrackingController extends Controller
{
    /**
     * @var PlanElementProcess
     */
    protected $planElementProcess;

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * @var OperationalGoalsTrackingProcess
     */
    private $operationalGoalsTrackingProcess;

    /**
     * Constructor de OperationalGoalsTrackingController.
     *
     * @param PlanElementProcess $planElementProcess
     * @param PlanElementRepository $planElementRepository
     * @param OperationalGoalsTrackingProcess $operationalGoalsTrackingProcess
     */
    public function __construct(
        PlanElementProcess $planElementProcess,
        PlanElementRepository $planElementRepository,
        OperationalGoalsTrackingProcess $operationalGoalsTrackingProcess
    ) {
        $this->planElementProcess = $planElementProcess;
        $this->planElementRepository = $planElementRepository;
        $this->operationalGoalsTrackingProcess = $operationalGoalsTrackingProcess;
    }

    /**
     * Desplegar lista de indicadores de objetivos operativos por año.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $params = $this->operationalGoalsTrackingProcess->index($request);
            $response['view'] = view('business.tracking.operational.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Desplegar avances por indicadores de objetivos operativos.
     *
     * @param int $id
     * @param string $year
     *
     * @return JsonResponse
     */
    public function indicators(int $id, string $year)
    {
        try {
            $params = $this->operationalGoalsTrackingProcess->indicators($id, $year);
            $response['view'] = view('business.tracking.indicators_layout', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

}
