<?php

namespace App\Http\Controllers\Business\Reports;

use App\Http\Controllers\Controller;
use App\Processes\Business\Reports\RoadsReportsProcess;
use App\Processes\Business\Roads\GeneralCharacteristicsOfTrackProcess;
use Illuminate\Http\JsonResponse;

use Throwable;

/**
 * Clase ReportsController
 * @package App\Http\Controllers\Business\Reports
 */
class RoadsReportsController extends Controller
{

    /**
     * @var GeneralCharacteristicsOfTrackProcess
     */
    protected $generalCharacteristicsOfTrackProcess;

    /**
     * @var RoadsReportsProcess
     */
    protected $roadsReportsProcess;

    /**
     * Constructor de RoadsReportsController.
     *
     * @param GeneralCharacteristicsOfTrackProcess $generalCharacteristicsOfTrackProcess
     * @param RoadsReportsProcess $roadsReportsProcess
     */
    public function __construct(
        GeneralCharacteristicsOfTrackProcess $generalCharacteristicsOfTrackProcess,
        RoadsReportsProcess $roadsReportsProcess
    )
    {
        $this->generalCharacteristicsOfTrackProcess = $generalCharacteristicsOfTrackProcess;
        $this->roadsReportsProcess = $roadsReportsProcess;
    }

    /**
     * Mostrar listado de todos los reportes de Gestión Vial.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.reports.roads.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar reporte de la longitud de la red vial cantonal por tipo de capa de rodadura
     *
     * @return JsonResponse
     */
    public function indexRoadLength()
    {
        try {
            $response['view'] = view('business.reports.roads.road_length',
                $this->generalCharacteristicsOfTrackProcess->indexReport()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte de la longitud de la red vial cantonal por tipo de capa de rodadura.
     *
     * @return string
     */
    public function dataRoadLength()
    {
        try {
            return $this->roadsReportsProcess->dataRoadLength();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar reporte del estado de la red vial cantonal por tipo de capa de rodadura
     *
     * @return JsonResponse
     */
    public function indexRoadStatus()
    {
        try {
            $response['view'] = view('business.reports.roads.road_status',
                $this->generalCharacteristicsOfTrackProcess->indexReport()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del reporte del estado de la red vial cantonal por tipo de capa de rodadura.
     *
     * @return string
     */
    public function dataRoadStatus()
    {
        try {
            return $this->roadsReportsProcess->dataRoadStatus();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar reporte de la longitud total de la red vial cantonal
     *
     * @return JsonResponse
     */
    public function indexRoadTotalLength()
    {
        try {
            $response['view'] = view('business.reports.roads.road_total_length',
                $this->generalCharacteristicsOfTrackProcess->indexReport()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar la información de la longitud total de la red vial cantonal
     *
     * @return JsonResponse
     */
    public function dataRoadTotalLength()
    {
        try {
            return $this->roadsReportsProcess->dataRoadTotalLength();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar reporte del estado general de la red vial cantonal
     *
     * @return JsonResponse
     */
    public function indexRoadGeneralStatus()
    {
        try {
            $response['view'] = view('business.reports.roads.road_general_status',
                $this->generalCharacteristicsOfTrackProcess->indexReport()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar la información de la longitud total de la red vial cantonal por estado de la vía.
     *
     * @return JsonResponse
     */
    public function dataRoadGeneralStatus()
    {
        try {
            return $this->roadsReportsProcess->dataRoadGeneralStatus();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }
}
