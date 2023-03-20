<?php

namespace App\Http\Controllers\Business\Tracking;

use App\Exports\DefaultReportExport;
use App\Http\Controllers\Controller;
use App\Models\Business\Task;
use App\Processes\Business\Tracking\ProjectPhysicalTrackingProcess;
use App\Processes\System\FileProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

/**
 * Clase ProjectPhysicalTrackingController
 * @package App\Http\Controllers\Business\Tracking
 */
class ProjectPhysicalTrackingController extends Controller
{

    /**
     * @var ProjectPhysicalTrackingProcess
     */
    protected $projectPhysicalTrackingProcess;

    /**
     * @var FileProcess
     */
    protected $fileProcess;

    /**
     * Constructor ProjectPhysicalTrackingController.
     *
     * @param ProjectPhysicalTrackingProcess $projectPhysicalTrackingProcess
     * @param FileProcess $fileProcess
     */
    public function __construct(
        ProjectPhysicalTrackingProcess $projectPhysicalTrackingProcess,
        FileProcess $fileProcess
    ) {
        $this->projectPhysicalTrackingProcess = $projectPhysicalTrackingProcess;
        $this->fileProcess = $fileProcess;
    }

    /**
     * Mostrar lista de actividades y sus tareas.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function index(int $id)
    {
        try {
            $params = $this->projectPhysicalTrackingProcess->index($id);
            $response['view'] = view('business.tracking.projects.physical.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga información de la tabla de actividades y sus tareas.
     *
     * @param Request $request
     *
     * @return JsonResponse.
     */
    public function loadTable(Request $request)
    {
        try {
            $params = $this->projectPhysicalTrackingProcess->loadTable($request);
            
            $response['view'] = view('business.tracking.projects.physical.loadTable', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    public function export(Request $request)
    {
        $data = $this->projectPhysicalTrackingProcess->loadTable($request);

        $view = view('business.tracking.projects.physical.export', ['rows' => $data['projectSchedule'], 'name' => $data['project']->name]);

        return Excel::download(new DefaultReportExport($view), trans('reports.poa.export_xls') . '.xlsx');

    }

    /**
     * Mostrar formulario de ingreso de avance físico
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function edit(int $id, Request $request)
    {
        try {
            $params = $this->projectPhysicalTrackingProcess->edit($id, $request);
            $response['modal'] = view('business.tracking.projects.physical.update', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar detalles de la tarea/hito
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function view(Request $request)
    {
        try {
            $params = $this->projectPhysicalTrackingProcess->edit($request->all()['id'], $request);
            $response['modal'] = view('business.tracking.projects.physical.detail', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar un avance
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        try {
            $this->projectPhysicalTrackingProcess->update($id, $request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('physical_progress.messages.success.update')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Llamada al proceso para eliminar un anexo.
     *
     * @param Request $request
     *
     * @return JsonResponse|mixed
     */
    public function destroyAttachment(Request $request)
    {
        try {
            $data = $request->all();

            $task = Task::find($data['task_id']);
            $this->fileProcess->destroy($data['file_id']);
            $task->load('files');

            $response = [
                'view' => view('business.tracking.projects.physical.files', ['files' => $task->files])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('files.messages.success.deleted')
                ],
                'required' => count($task->files) == 0
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para descargar un anexo.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function downloadFile(int $id)
    {
        try {
            return $this->fileProcess->download($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar el avance de una tarea.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->projectPhysicalTrackingProcess->destroy($id);

            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('physical_progress.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Carga información para generar el diagrama de gantt.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function loadGantt(Request $request)
    {
        try {
            $params = $this->projectPhysicalTrackingProcess->loadGantt($request);
            $response['view'] = view('business.tracking.projects.physical.loadGantt', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga información para generar el avance trimestral.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadQuarterlyProgress(Request $request)
    {
        try {
            $params = $this->projectPhysicalTrackingProcess->loadQuarterlyProgress($request->all());
            $response['view'] = view('business.tracking.projects.physical.loadQuarterlyProgress', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Exporta el avance físico a excel.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function exportQuarterlyProgress(Request $request)
    {
        try {
            $data = $this->projectPhysicalTrackingProcess->loadQuarterlyProgress($request->all());
            $view = view('business.tracking.projects.physical.tableQuarterlyProgress', $data);
            return Excel::download(new DefaultReportExport($view), trans('physical_progress.labels.file_name') . '.xlsx');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Aprueba el avance físico
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function approve(int $id)
    {
        try {
            $this->projectPhysicalTrackingProcess->approve($id);

            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('physical_progress.messages.success.approved')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra modal de confirmación de rechazo de un avance
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function rejectObservations(Request $request)
    {
        try {
            $response['modal_st'] = view('business.planning.partials.rejections.form', [
                'data' => $request->all()
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Rechaza el avance físico
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function reject(Request $request)
    {
        try {
            $this->projectPhysicalTrackingProcess->reject($request);

            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('physical_progress.messages.success.rejected')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra modal con el listado de rechazos de una tarea/hito
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function rejectionsLog(Request $request)
    {
        try {
            $data = $this->projectPhysicalTrackingProcess->rejectionsLog($request);

            $response['modal'] = view('business.tracking.projects.physical.rejections', $data)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Genera la estructura de datatable de rechazos
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function rejectionsLogData(Request $request)
    {
        try {
            return $this->projectPhysicalTrackingProcess->rejectionsLogData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }

    }

}