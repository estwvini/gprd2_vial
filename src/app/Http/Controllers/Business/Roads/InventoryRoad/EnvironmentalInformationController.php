<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Repositories\Repository\Business\Roads\EnvironmentalInformationRepository;
use App\Processes\Business\Roads\EnvironmentalInformationProcess;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;

/**
 * Clase EnvironmentalInformationController
 * @package App\Http\Controllers\Business\Roads\InventoryVial
 */
class EnvironmentalInformationController extends Controller
{

    /**
     * @var EnvironmentalInformationProcess
     */
    protected $environmentalInformationProcess;

    /**
     * @var EnvironmentalInformationRepository
     */
    protected $environmentalInformationRepository;

    /**
     * Constructor de EnvironmentalInformationController.
     *
     * @param EnvironmentalInformationProcess $environmentalInformationProcess
     * @param EnvironmentalInformationRepository $environmentalInformationRepository
     */
    public function __construct(
        EnvironmentalInformationProcess $environmentalInformationProcess,
        EnvironmentalInformationRepository $environmentalInformationRepository
    )
    {
        $this->environmentalInformationProcess = $environmentalInformationProcess;
        $this->environmentalInformationRepository = $environmentalInformationRepository;
    }

    /**
     * Mostrar vista de listado de información ambiental.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function index(string $code)
    {
        try {
            $response['view'] = view('business.roads.environmental_information.index',
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
     * Mostrar vista de listado de información ambiental sin acciones.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function indexShow(string $code)
    {
        try {
            $response['view'] = view('business.roads.environmental_information.index_show',
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
     * Llamada al proceso para cargar información de un informe ambiental de la vía.
     *
     * @param string $code
     *
     * @return mixed|string
     */
    public function data(string $code)
    {
        try {
            return $this->environmentalInformationProcess->data($code);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de un informe ambiental de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function create(string $code)
    {
        try {
            $response = $this->environmentalInformationProcess->create($code);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar una necesidad de un informe ambiental de la vía.
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
                    $this->environmentalInformationProcess->store($request)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('environmental_information.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de un informe ambiental de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['modal'] = view('business.roads.environmental_information.update',
                $this->environmentalInformationProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de un informe ambiental de la vía.
     *
     * @param Request $request
     * @param  string $code
     *
     * @return JsonResponse
     */
    public function update(Request $request, string $gid)
    {
        try {
            $response = [
                'view' => view('business.roads.general_characteristics_of_track.edit_components',
                    $this->environmentalInformationProcess->update($request, $gid)
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('environmental_information.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de un informe ambiental de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function show(string $code)
    {
        try {
            $response['modal'] = view('business.roads.environmental_information.show',
                $this->environmentalInformationProcess->show($code)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}