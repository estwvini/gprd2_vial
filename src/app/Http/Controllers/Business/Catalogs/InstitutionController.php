<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\InstitutionProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase InstitutionController
 * @package App\Http\Controllers\Business\Catalogs
 */
class InstitutionController extends Controller
{
    /**
     * @var InstitutionProcess
     */
    protected $institutionProcess;

    /**
     * Constructor de InstitutionController.
     *
     * @param InstitutionProcess $institutionProcess
     */
    public function __construct(InstitutionProcess $institutionProcess)
    {
        $this->institutionProcess = $institutionProcess;
    }

    /**
     * Mostrar vista de listado de instituciones.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.institution.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de institucion.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->institutionProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de institucion.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.catalogs.institution.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nueva institucion.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->institutionProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.institution.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('institution.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de institucion.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.institution.update',
                $this->institutionProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de institucion.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->institutionProcess->update($request->all(), $id);

            $response = [
                'view' => view('business.catalogs.institution.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('institution.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar una institucion.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->institutionProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.institution.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('institution.messages.success.deleted')
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
            $entity = $this->institutionProcess->status($id);

            $response['message'] = [
                'type' => 'success',
                'text' => ($entity->enabled) ? trans('institution.messages.success.status_on') : trans('institution.messages.success.status_off')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
