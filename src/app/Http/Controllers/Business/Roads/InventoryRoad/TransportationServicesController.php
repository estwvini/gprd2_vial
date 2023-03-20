<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Processes\Business\Roads\TransportationServicesProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase TransportationServicesController
 * @package App\Http\Controllers\Business\Roads\InventoryRoad
 */
class TransportationServicesController extends Controller
{

    /**
     * @var TransportationServicesProcess
     */
    protected $transportationServicesProcess;

    /**
     * Constructor de TransportationServicesController.
     *
     * @param TransportationServicesProcess $transportationServicesProcess
     */
    public function __construct(
        TransportationServicesProcess $transportationServicesProcess
    )
    {
        $this->transportationServicesProcess = $transportationServicesProcess;
    }

    /**
     * Mostrar vista de listado de servicios de transporte.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function index(string $code)
    {
        try {
            $response['view'] = view('business.roads.transportation_services.index',
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
     * Mostrar vista de listado de servicios de transporte sin acciones.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function indexShow(string $code)
    {
        try {
            $response['view'] = view('business.roads.transportation_services.index_show',
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
     * Llamada al proceso para cargar información de un servicio de tansporte de la vía.
     *
     * @return mixed|string
     */
    public function data(string $code)
    {
        try {
            return $this->transportationServicesProcess->data($code);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de un servicio de tansporte de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */

    public function create(string $code)
    {
        try {
            $response['modal'] = view('business.roads.transportation_services.create',
                $this->transportationServicesProcess->create($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar una necesidad de un servicio de tansporte de la vía.
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
                    $this->transportationServicesProcess->store($request)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('transportation_services.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de un servicio de tansporte de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['modal'] = view('business.roads.transportation_services.update',
                $this->transportationServicesProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de un servicio de tansporte de la vía.
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
                    $this->transportationServicesProcess->update($request, $gid)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('transportation_services.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de un servicio de tansporte de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function show(string $code)
    {
        try {
            $response['modal'] = view('business.roads.transportation_services.show',
                $this->transportationServicesProcess->show($code)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}