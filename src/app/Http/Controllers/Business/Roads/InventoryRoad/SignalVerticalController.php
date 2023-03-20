<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Processes\Business\Roads\VerticalSignalProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase SignalVerticalController
 * @package App\Http\Controllers\Business\Roads\InventoryVial
 */
class SignalVerticalController extends Controller
{

    /**
     * @var VerticalSignalProcess
     */
    protected $verticalSignalProcess;

    /**
     * Constructor de SignalVerticalController.
     *
     * @param VerticalSignalProcess $verticalSignalProcess
     */
    public function __construct(
        VerticalSignalProcess $verticalSignalProcess
    )
    {
        $this->verticalSignalProcess = $verticalSignalProcess;
    }

    /**
     * Llamada al proceso para cargar información de las senalizaciones verticales de la vía.
     *
     * @param string $code
     *
     * @return mixed|string
     */
    public function data(string $code)
    {
        try {
            return $this->verticalSignalProcess->data($code);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar vista de listado de senalizaciones verticales.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function index(string $code)
    {
        try {
            $response['view'] = view('business.roads.signal_vertical.index',
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
     * Mostrar vista de listado de senalizaciones verticales sin acciones.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function indexShow(string $code)
    {
        try {
            $response['view'] = view('business.roads.signal_vertical.index_show',
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
     * Llamada al proceso para mostrar el formulario de creación de una senalización vertical de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function create(string $code)
    {
        try {
            $response['modal'] = view('business.roads.signal_vertical.create',
                $this->verticalSignalProcess->create($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar una senalización vertical de la vía.
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
                    $this->verticalSignalProcess->store($request)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('signal_vertical.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de una senalización vertical de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['modal'] = view('business.roads.signal_vertical.update',
                $this->verticalSignalProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de una senalización vertical de la vía.
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
                    $this->verticalSignalProcess->update($request, $gid)
                )->
                render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('signal_vertical.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de una senalización vertical de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function show(string $code)
    {
        try {
            $response['modal'] = view('business.roads.signal_vertical.show',
                $this->verticalSignalProcess->show($code)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}