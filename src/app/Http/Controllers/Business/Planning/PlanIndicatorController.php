<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\PlanIndicator;
use App\Processes\Business\Planning\PlanIndicatorProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\Response;

/**
 * Clase PlanIndicatorController
 * @package App\Http\Controllers\Business\Planning
 */
class PlanIndicatorController extends Controller
{
    /**
     * @var PlanIndicatorProcess
     */
    protected $planIndicatorProcess;

    /**
     * Constructor de PlanIndicatorController.
     *
     * @param PlanIndicatorProcess $planIndicatorProcess
     */
    public function __construct(
        PlanIndicatorProcess $planIndicatorProcess
    ) {
        $this->planIndicatorProcess = $planIndicatorProcess;
    }

    /**
     * Desplegar lista de indicadores.
     *
     * @param int $planElementId
     *
     * @return Response
     */
    public function index(int $planElementId)
    {
        try {
            $response['view'] = view('business.planning.indicators.index', [
                'planElementId' => $planElementId
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la respuesta ajax del datatable
     *
     * @param int $planElementId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(int $planElementId)
    {
        try {
            return $this->planIndicatorProcess->data($planElementId);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Almacenar un indicador nuevo en la base de datos.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $indicatorableId
     * @param string $indicatorableType
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, int $indicatorableId, string $indicatorableType)
    {
        try {
            return response()->json($this->planIndicatorProcess->store($request, $indicatorableId, $indicatorableType));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar formulario de edición de un indicador del plan.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, int $id)
    {
        try {
            return response()->json($this->planIndicatorProcess->edit($id, $request->all()['url']));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar formulario de edición de un indicador del plan.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editWizard(int $id)
    {
        try {
            return response()->json($this->planIndicatorProcess->edit($id));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualizar indicador.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            return response()->json($this->planIndicatorProcess->update($request, $id));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar Indicador.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $response = $this->planIndicatorProcess->show($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Elimina un indicador.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $response = $this->planIndicatorProcess->destroy($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Llamada al proceso para descargar un archivo técnico.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function download(int $id)
    {
        try {
            return $this->planIndicatorProcess->download($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar un archivo técnico.
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroyFile(int $id)
    {
        try {
            $response = $this->planIndicatorProcess->deleteFile($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);

    }

}
