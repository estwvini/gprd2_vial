<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\MeasureUnitProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase MeasureUnitController
 * @package App\Http\Controllers\Business\Catalogs
 */
class MeasureUnitController extends Controller
{
    /**
     * @var MeasureUnitProcess
     */
    protected $measureUnitProcess;

    /**
     * Constructor de MeasureUnitController.
     *
     * @param MeasureUnitProcess $measureUnitProcess
     */
    public function __construct(MeasureUnitProcess $measureUnitProcess)
    {
        $this->measureUnitProcess = $measureUnitProcess;
    }

    /**
     * Mostrar vista de listado de unidades de medida.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.measure_unit.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de unidad de medida.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->measureUnitProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de unidad de medida.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.catalogs.measure_unit.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nueva unidad de medida.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->measureUnitProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.measure_unit.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('measure_units.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de unidad de medida.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.measure_unit.update',
                $this->measureUnitProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de unidad de medida.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->measureUnitProcess->update($request, $id);

            $response = [
                'view' => view('business.catalogs.measure_unit.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('measure_units.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar una unidad de medida.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->measureUnitProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.measure_unit.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('measure_units.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cambiar de estado una compra pública.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            $entity = $this->measureUnitProcess->status($id);

            $response['message'] = [
                'type' => 'success',
                'text' => ($entity->enabled) ? trans('measure_units.messages.success.status_on') : trans('measure_units.messages.success.status_off')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
