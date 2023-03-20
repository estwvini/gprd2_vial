<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\LinkProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase LinkController
 * @package App\Http\Controllers\Business\Planning
 */
class LinkController extends Controller
{


    /**
     * @var LinkProcess
     */
    protected $linkProcess;

    /**
     * Constructor PlanController.
     *
     * @param LinkProcess $linkProcess
     */
    public function __construct(
        LinkProcess $linkProcess
    ) {
        $this->linkProcess = $linkProcess;
    }

    /**
     * Muestra pantalla de articulaciones
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function linkPlan(int $id)
    {
        try {
            $response = $this->linkProcess->linkPlan($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra las articulaciones de la meta de un plan
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadLinks(Request $request)
    {
        try {
            $response = $this->linkProcess->loadLinks($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacena una articulación en la base de datos
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $response = $this->linkProcess->store($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Elimina una articulación de la base de datos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            $response = $this->linkProcess->destroy($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Obtiene información básica de un indicador de un plan
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getIndicatorInfo(Request $request)
    {
        try {
            $response = $this->linkProcess->getIndicatorInfo($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra modal con la vista previa de las articulaciones realizadas
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function preview(Request $request)
    {
        try {
            $response = $this->linkProcess->preview($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga tabla de articulaciones
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function loadPreviewTable(Request $request)
    {
        try {
            return $this->linkProcess->loadPreviewTable($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
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
}
