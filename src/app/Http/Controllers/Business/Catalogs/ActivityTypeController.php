<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\ActivityTypeProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ActivityTypeController
 *
 * @package App\Http\Controllers\Business\Catalogs
 */
class ActivityTypeController extends Controller
{
    /**
     * @var ActivityTypeProcess
     */
    protected $activityTypeProcess;

    /**
     * Constructor de ActivityTypeController.
     *
     * @param ActivityTypeProcess $activityTypeProcess
     */
    public function __construct(ActivityTypeProcess $activityTypeProcess)
    {
        $this->activityTypeProcess = $activityTypeProcess;
    }

    /**
     * Mostrar vista de listado de tipos de actividades.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.activity_type.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de los tipos de actividades.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->activityTypeProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de los tipos de actividades.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.catalogs.activity_type.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevo tipo de actividad.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->activityTypeProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.activity_type.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('activity_type.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición del tipo de actividad.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.activity_type.update',
                $this->activityTypeProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información del tipo de actividad.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->activityTypeProcess->update($request->all(), $id);

            $response = [
                'view' => view('business.catalogs.activity_type.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('activity_type.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar un tipo de actividad.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->activityTypeProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.activity_type.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('activity_type.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
