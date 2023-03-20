<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Processes\Business\Roads\CharacteristicsOfTrackProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase CharacteristicsOfTrackController
 * @package App\Http\Controllers\Business\Roads\InventoryRoad
 */
class CharacteristicsOfTrackController extends Controller
{

    /**
     * @var CharacteristicsOfTrackProcess
     */
    protected $characteristicsOfTrackProcess;

    /**
     * Constructor de CharacteristicsOfTrackController.
     *
     * @param CharacteristicsOfTrackProcess $characteristicsOfTrackProcess
     */
    public function __construct(
        CharacteristicsOfTrackProcess $characteristicsOfTrackProcess
    )
    {
        $this->characteristicsOfTrackProcess = $characteristicsOfTrackProcess;

    }

    /**
     * Llamada al proceso para cargar información de una caracteristica de la vía.
     *
     * @param string $code
     *
     * @return mixed|string
     */
    public function data(string $code)
    {
        try {
            return $this->characteristicsOfTrackProcess->data($code);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de una caracteristica de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function create(string $code)
    {
        try {
            $response['modal'] = view('business.roads.characteristics_of_track.create',
                $this->characteristicsOfTrackProcess->create($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar una caracteristica de la vía.
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
                    $this->characteristicsOfTrackProcess->store($request)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('characteristics_of_track.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de una caracteristica de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['modal'] = view('business.roads.characteristics_of_track.update',
                $this->characteristicsOfTrackProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de una caracteristica de la vía.
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
                    $this->characteristicsOfTrackProcess->update($request, $gid)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('characteristics_of_track.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de una caracteristica de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function show(string $code)
    {
        try {
            $response['modal'] = view('business.roads.characteristics_of_track.show',
                $this->characteristicsOfTrackProcess->show($code)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}