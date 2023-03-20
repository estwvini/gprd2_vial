<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Processes\Business\Roads\ShapeProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase ShapeController
 * @package App\Http\Controllers\Business\Roads\InventoryRoad
 */
class ShapeController extends Controller
{

    /**
     * @var ShapeProcess
     */
    protected $shapeProcess;

    /**
     * Constructor de ShapeController.
     *
     * @param ShapeProcess $shapeProcess
     */
    public function __construct(
        ShapeProcess $shapeProcess
    )
    {
        $this->shapeProcess = $shapeProcess;
    }

    /**
     * Mostrar vista de listado de shapes.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function index(string $code)
    {
        try {
            $response['view'] = view('business.roads.shape.index',
                [
                    'code' => $code
                ]
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Mostrar vista de listado de shapes sin acciones.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function indexShow(string $code)
    {
        try {
            $response['view'] = view('business.roads.shape.index_show',
                [
                    'code' => $code
                ]
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para ver listado de shapes.
     *
     * @param string $code
     * @param bool $show
     *
     * @return mixed|string
     */
    public function data(string $code, bool $show = false)
    {
        try {
            return $this->shapeProcess->data($code, $show);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de subida de shapes.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function create(string $code)
    {
        try {
            $response['modal'] = view('business.roads.shape.create', [
                'code' => $code
            ])->render();
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
            $data = $this->shapeProcess->store($request);

            $response = [
                'view' => view('business.roads.general_characteristics_of_track.edit_components',
                    $data
                )->render(),
                'message' => $data['message']
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de un shape.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['modal'] = view('business.roads.shape.update',
                $this->shapeProcess->edit($code)
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
            $entity = $this->shapeProcess->update($request, $gid);
            $response = [
                'view' => view('business.roads.general_characteristics_of_track.edit_components',
                    $entity['entity']
                )->render(),
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
            $response = [
                'view' => view('business.roads.general_characteristics_of_track.edit_components',
                    $this->shapeProcess->destroy($gid)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('shape.messages.success.delete')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}