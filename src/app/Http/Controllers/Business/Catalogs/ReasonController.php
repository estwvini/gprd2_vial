<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\ReasonProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ReasonController
 *
 * @package App\Http\Controllers\Business\Catalogs
 */
class ReasonController extends Controller
{
    /**
     * @var ReasonProcess
     */
    protected $reasonProcess;

    /**
     * Constructor de ReasonController.
     *
     * @param ReasonProcess $reasonProcess
     */
    public function __construct(ReasonProcess $reasonProcess)
    {
        $this->reasonProcess = $reasonProcess;
    }

    /**
     * Mostrar vista de listado de motivos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.reason.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de los motivos.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->reasonProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de los motivos.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.catalogs.reason.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevo motivo.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->reasonProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.reason.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('reason.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición del motivo.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.reason.update',
                $this->reasonProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información del motivo.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->reasonProcess->update($request, $id);

            $response = [
                'view' => view('business.catalogs.reason.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('reason.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar un motivo.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->reasonProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.reason.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('reason.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
