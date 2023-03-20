<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Processes\Business\Roads\MainShapeProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase MainShapeController
 * @package App\Http\Controllers\Business\Roads\InventoryRoad
 */
class MainShapeController extends Controller
{

    /**
     * @var MainShapeProcess
     */
    protected $mainShapeProcess;

    /**
     * Constructor de MainShapeController.
     *
     * @param MainShapeProcess $mainShapeProcess
     */
    public function __construct(
        MainShapeProcess $mainShapeProcess
    )
    {
        $this->mainShapeProcess = $mainShapeProcess;
    }

    /**
     * Mostrar vista de listado de shapes.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.roads.main_shape.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }      
        return response()->json($response);
    }

    /**
     * Llamada al proceso para ver listado de shapes.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->mainShapeProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de subida de shapes.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['modal'] = view('business.roads.main_shape.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar un shape.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $response = $this->mainShapeProcess->store($request);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de un shape.
     *
     * @param int $gid
     *
     * @return JsonResponse
     */
    public function edit(int $gid)
    {
        try {
            $response['modal'] = view('business.roads.main_shape.update',
                $this->mainShapeProcess->edit($gid)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de un shape.
     *
     * @param Request $request
     * @param  int $gid
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $gid)
    {
        try {
            $entity = $this->mainShapeProcess->update($request, $gid);
            $response = [
                'view' => view('business.roads.main_shape.index')->render(),
                'message' => [
                    'type' => $entity['message']['type'],
                    'text' => $entity['message']['text']
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar un shape.
     *
     * @param  int $gid
     *
     * @return JsonResponse
     */
    public function destroy(int $gid)
    {
        try {
            $response = $this->mainShapeProcess->destroy($gid);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

     /**
     * Mostrar vista de consulta en shapes.
     *
     * @return JsonResponse
     */
    public function shapeQuery(Request $request)
    {
        try {
            return $this->mainShapeProcess->shapeQuery($request->all()['filters']);
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
        }
    }
}