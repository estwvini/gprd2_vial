<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Processes\Business\Roads\BridgeProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase BridgeController
 * @package App\Http\Controllers\Business\Roads\InventoryRoad
 */
class BridgeController extends Controller
{

    /**
     * @var BridgeProcess
     */
    protected $bridgeProcess;

    /**
     * Constructor de BridgeController.
     *
     * @param BridgeProcess $bridgeProcess
     */
    public function __construct(
        BridgeProcess $bridgeProcess
    )
    {
        $this->bridgeProcess = $bridgeProcess;
    }

    /**
     * Mostrar vista de listado de puentes.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function index(string $code)
    {
        try {
            $response['view'] = view('business.roads.bridge.index',
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
     * Mostrar vista de listado de puentes sin acciones.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function indexShow(string $code)
    {
        try {
            $response['view'] = view('business.roads.bridge.index_show',
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
     * Llamada al proceso para cargar información de un puente de la vía.
     *
     * @param string $code
     *
     * @return mixed|string
     */
    public function data(string $code)
    {
        try {
            return $this->bridgeProcess->data($code);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de un puente de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function create(string $code)
    {
        try {
            $response['modal'] = view('business.roads.bridge.create',
                $this->bridgeProcess->create($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar un puente de la vía.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $response = [
                'view' => view('business.roads.general_characteristics_of_track.edit_components',
                    $this->bridgeProcess->store($request)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('bridge.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de un puente de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['modal'] = view('business.roads.bridge.update',
                $this->bridgeProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de un puente de la vía.
     *
     * @param Request $request
     * @param  string $gid
     *
     * @return JsonResponse
     */
    public function update(Request $request, string $gid)
    {
        try {
            $response = [
                'view' => view('business.roads.general_characteristics_of_track.edit_components',
                    $this->bridgeProcess->update($request, $gid)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('bridge.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de un puente de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function show(string $code)
    {
        try {
            $response['modal'] = view('business.roads.bridge.show',
                $this->bridgeProcess->show($code)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

}