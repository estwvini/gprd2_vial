<?php

namespace App\Http\Controllers\Business\Execution;

use App\Http\Controllers\Controller;
use App\Models\Business\AdminActivity;
use App\Processes\Business\Execution\AdminActivityProcess;
use App\Processes\System\FileProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase AdminActivityController
 *
 * @package App\Http\Controllers\Business\Execution
 */
class AdminActivityController extends Controller
{
    /**
     * @var AdminActivityProcess
     */
    private $adminActivityProcess;

    /**
     * @var FileProcess
     */
    private $fileProcess;

    /**
     * Constructor SchedulePhysicalReprogrammingController.
     *
     * @param AdminActivityProcess $adminActivityProcess
     * @param FileProcess $fileProcess
     */
    public function __construct(AdminActivityProcess $adminActivityProcess, FileProcess $fileProcess)
    {
        $this->adminActivityProcess = $adminActivityProcess;
        $this->fileProcess = $fileProcess;
    }

    /**
     * Listar actividades
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.execution.admin_activities.index', $this->adminActivityProcess->dataCreate())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de actividades operativas.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function data(Request $request)
    {
        try {
            return $this->adminActivityProcess->data($request->all()['filters']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Crear actividades
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['modal'] = view('business.execution.admin_activities.create', $this->adminActivityProcess->dataCreate())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Editar actividades
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            setlocale(LC_TIME, 'es_ES.utf8');
            $response['modal'] = view('business.execution.admin_activities.update', $this->adminActivityProcess->dataEdit($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacenar nueva actividad
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->adminActivityProcess->store($request->all()['activity']);
            $response = [
                'view' => view('business.execution.admin_activities.index', $this->adminActivityProcess->dataCreate())->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('admin_activities.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar una actividad
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $this->adminActivityProcess->update($request->all()['activity']);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('admin_activities.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return $response;
    }

    /**
     * Eliminar una actividad
     *
     * @param AdminActivity $adminActivity
     *
     * @return JsonResponse
     */
    public function delete(AdminActivity $adminActivity)
    {
        try {
            $adminActivity->delete();
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('admin_activities.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return $response;
    }

    /**
     * Cargar archivos
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     */
    public function upload(int $id, Request $request)
    {
        try {
            $entity = $this->adminActivityProcess->upload($id, $request->all());
            if ($entity) {
                $response = [
                    'view' => view('business.execution.admin_activities.partial.files', ['entity' => $entity])->render(),
                    'message' => [
                        'type' => 'success',
                        'text' => trans('admin_activities.messages.success.file', ['name' => $entity->name])
                    ]
                ];
            } else {
                $response = [
                    'message' => [
                        'type' => 'error',
                        'text' => trans('admin_activities.messages.errors.file')
                    ]
                ];
            }

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Llamada al proceso para descargar un archivo.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function download(int $id)
    {
        try {
            return $this->fileProcess->download($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para elimnar un archivo.
     *
     * @param int $id
     * @param int $idActivity
     *
     * @return JsonResponse|mixed
     */
    public function deleteFile(int $idActivity, int $id)
    {
        try {

            $entity = $this->adminActivityProcess->destroyFile($idActivity, $id);
            $response = [
                'view' => view('business.execution.admin_activities.partial.files', ['entity' => $entity])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('admin_activities.messages.success.file_deleted')
                ]
            ];

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para guardar un comentario
     *
     * @param Request $request
     * @param int $idActivity
     *
     * @return JsonResponse
     */
    public function storeComment(Request $request, int $idActivity)
    {
        try {

            $entity = $this->adminActivityProcess->storeComment($idActivity, $request->all());
            $response = [
                'view' => view('business.execution.admin_activities.partial.comments', ['entity' => $entity])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('admin_activities.messages.success.comment_created')
                ]
            ];

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Retorna data en formato JSON para gráfica de estados de actividad
     *
     * @return JsonResponse
     */
    public function chart_1()
    {
        try {
            $result = $this->adminActivityProcess->chart_1();

        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para gráfica de prioridad de actividad
     *
     * @return JsonResponse
     */
    public function chart_2()
    {
        try {
            $result = $this->adminActivityProcess->chart_2();

        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para gráfica de actividades por usuario
     *
     * @return JsonResponse
     */
    public function chart_3()
    {
        try {
            $result = $this->adminActivityProcess->chart_3();

        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }

    /**
     * Retorna data en formato JSON para el calendario de actividades
     *
     * @return JsonResponse
     */
    public function calendar()
    {
        try {
            $result = $this->adminActivityProcess->calendar();
        } catch (Throwable $e) {
            $result = [];
        }
        return response()->json($result);
    }
}