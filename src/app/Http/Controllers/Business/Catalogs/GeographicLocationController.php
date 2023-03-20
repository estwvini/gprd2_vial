<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Processes\Business\Catalogs\GeographicLocationProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use Throwable;

/**
 * Clase GeographicLocationController
 * @package App\Http\Controllers\Business\Catalogs
 */
class GeographicLocationController extends Controller
{
    /**
     * @var GeographicLocationProcess
     */
    protected $geographicLocationProcess;

    /**
     * Constructor de GeographicLocationController.
     *
     * @param GeographicLocationProcess $geographicLocationProcess
     */
    public function __construct(GeographicLocationProcess $geographicLocationProcess)
    {
        $this->geographicLocationProcess = $geographicLocationProcess;
    }

    /**
     * Mostrar vista de listado de catálogo geográfico.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.geographic_location.index', [
                'cantons' => $this->geographicLocationProcess->byTypes(GeographicLocation::TYPE_CANTON),
                'province' => $this->geographicLocationProcess->currentProvince()
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de localización geográfica.
     *
     * @param Request $request
     *
     * @return string
     * @throws JsonException
     */
    public function data(Request $request)
    {
        try {
            return $this->geographicLocationProcess->data($request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de localización geográfica.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $response['view'] = view('business.catalogs.geographic_location.create',
                $this->geographicLocationProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nueva localización geográfica.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $entity = $this->geographicLocationProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.geographic_location.index', [
                    'province' => $this->geographicLocationProcess->currentProvince(),
                    'cantons' => $this->geographicLocationProcess->byTypes(GeographicLocation::TYPE_CANTON)
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => (isset($entity->parent_id)) ? trans('geographic_locations.messages.success.created', ['type' => trans('geographic_locations.labels.PARISH')])
                        : trans('geographic_locations.messages.success.created', ['type' => trans('geographic_locations.labels.CANTON')])
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }


    /**
     * Llamada al proceso para mostrar la información de localización geográfica.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $response['modal_st'] = view('business.catalogs.geographic_location.show',
                $this->geographicLocationProcess->show($id)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de localización geográfica.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.geographic_location.update',
                $this->geographicLocationProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de localización geográfica.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $entity = $this->geographicLocationProcess->update($request, $id);

            $response = [
                'view' => view('business.catalogs.geographic_location.index', [
                    'province' => $this->geographicLocationProcess->currentProvince(),
                    'cantons' => $this->geographicLocationProcess->byTypes(GeographicLocation::TYPE_CANTON)
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => (isset($entity->parent_id)) ? trans('geographic_locations.messages.success.updated', ['type' => trans('geographic_locations.labels.PARISH')])
                        : trans('geographic_locations.messages.success.updated', ['type' => trans('geographic_locations.labels.CANTON')])
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar lógicamente una localización geográfica.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $hasParent = $this->geographicLocationProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.geographic_location.index', [
                    'province' => $this->geographicLocationProcess->currentProvince(),
                    'cantons' => $this->geographicLocationProcess->byTypes(GeographicLocation::TYPE_CANTON)
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => ($hasParent) ? trans('geographic_locations.messages.success.deleted', ['type' => trans('geographic_locations.labels.PARISH')])
                        : trans('geographic_locations.messages.success.deleted', ['type' => trans('geographic_locations.labels.CANTON')])
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cambiar de estado una localización geográfica.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            $entity = $this->geographicLocationProcess->status($id);
            $type = isset($entity->parent_id) ? trans('geographic_locations.labels.PARISH')
                : trans('geographic_locations.labels.CANTON');
            $message = ($entity->enabled) ? trans('geographic_locations.messages.success.status_on', ['type' => $type])
                : trans('geographic_locations.messages.success.status_off', ['type' => $type]);

            $response['message'] = [
                'type' => 'success',
                'text' => $message
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Retorna una lista segun el tipo
     *
     * @param string $type
     *
     * @return JsonResponse
     */
    public function loadByTypes(string $type)
    {
        try {
            return response()->json($this->geographicLocationProcess->byTypes($type));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}
