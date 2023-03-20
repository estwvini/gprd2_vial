<?php

namespace App\Http\Controllers\Business\Tracking;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Processes\Business\Tracking\SectoralPlansTrackingProcess;
use App\Repositories\Repository\Business\PlanElementRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase SectoralPlansTrackingController
 * @package App\Http\Controllers\Business\Tracking
 */
class SectoralPlansTrackingController extends Controller
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
     * @var SectoralPlansTrackingProcess
     */
    private $sectoralPlansTrackingProcess;

    /**
     * Constructor de SectoralPlansTrackingController.
     *
     * @param PlanElementProcess $planElementProcess
     * @param PlanElementRepository $planElementRepository
     * @param SectoralPlansTrackingProcess $sectoralPlansTrackingProcess
     */
    public function __construct(
        PlanElementProcess $planElementProcess,
        PlanElementRepository $planElementRepository,
        SectoralPlansTrackingProcess $sectoralPlansTrackingProcess
    ) {
        $this->planElementProcess = $planElementProcess;
        $this->planElementRepository = $planElementRepository;
        $this->sectoralPlansTrackingProcess = $sectoralPlansTrackingProcess;
    }

    /**
     * Muestra la vista del seguimiento de planes sectoriales.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $params = $this->sectoralPlansTrackingProcess->index();
            $response['view'] = view('business.tracking.sectoral.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra la información de los objetivos del plan sectorial.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function data(Request $request)
    {
        try {
            $params = $this->sectoralPlansTrackingProcess->data($request['id']);
            $response['view'] = view('business.tracking.base_layout', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Desplegar avances por indicadores de objetivos de un plan sectorial.
     *
     * @param int $id
     * @param string $year
     *
     * @return JsonResponse
     */
    public function indicators(int $id, string $year)
    {
        try {
            $params = $this->sectoralPlansTrackingProcess->indicators($id, $year);
            $response['view'] = view('business.tracking.indicators_layout', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

}
