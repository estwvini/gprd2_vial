<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Processes\Business\Roads\ConservationNeedsProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase ConservationNeedsController
 * @package App\Http\Controllers\Business\Roads\InventoryRoad
 */
class ConservationNeedsController extends Controller
{

    /**
     * @var ConservationNeedsProcess
     */
    protected $conservationNeedsProcess;

    /**
     * Constructor de ConservationNeedsController.
     *
     * @param ConservationNeedsProcess $conservationNeedsProcess
     */
    public function __construct(
        ConservationNeedsProcess $conservationNeedsProcess
    )
    {
        $this->conservationNeedsProcess = $conservationNeedsProcess;
    }

    /**
     * Mostrar vista de listado de necesidades de conservación.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function index(string $code)
    {
        try {
            $response['view'] = view('business.roads.conservation_needs.index',
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
     * Mostrar vista de listado de necesidades de conservación sin acciones.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function indexShow(string $code)
    {
        try {
            $response['view'] = view('business.roads.conservation_needs.index_show',
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
     * Llamada al proceso para cargar información de una necesidad de conservación de la vía.
     *
     * @param string $code
     *
     * @return mixed|string
     */
    public function data(string $code)
    {
        try {
            return $this->conservationNeedsProcess->data($code);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de una necesidad de conservación de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function create(string $code)
    {
        try {
            $response['modal'] = view('business.roads.conservation_needs.create',
                $this->conservationNeedsProcess->create($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar una necesidad de conservación de la vía.
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
                    $this->conservationNeedsProcess->store($request)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('conservation_needs.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de uns necesidad de conservación de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['modal'] = view('business.roads.conservation_needs.update',
                $this->conservationNeedsProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de una necesidad de conservación de la vía.
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
                    $this->conservationNeedsProcess->update($request, $gid)
                )->
                render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('conservation_needs.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de una necesidad de conservación de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function show(string $code)
    {
        try {
            $response['modal'] = view('business.roads.conservation_needs.show',
                $this->conservationNeedsProcess->show($code)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}