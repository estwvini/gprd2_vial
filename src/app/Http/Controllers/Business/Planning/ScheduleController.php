<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Processes\Business\Planning\ScheduleProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase ScheduleController
 * @package App\Http\Controllers\Business\Planning
 */
class ScheduleController extends Controller
{

    /**
     * @var ScheduleProcess
     */
    protected $scheduleProcess;

    /**
     * Constructor ScheduleController.
     *
     * @param ScheduleProcess $scheduleProcess
     */
    public function __construct(
        ScheduleProcess $scheduleProcess
    )
    {
        $this->scheduleProcess = $scheduleProcess;
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
            $params = $this->scheduleProcess->index($id);
            $response['view'] = view('business.planning.projects.schedule.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar lista de actividades y sus tareas Revisión.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function indexShow(int $id)
    {
        try {
            $params = $this->scheduleProcess->index($id);
            $response['view'] = view('business.planning.project_review.schedule.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga información de la tabla de actividades.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadTable(Request $request)
    {
        try {
            $params = $this->scheduleProcess->loadTable($request->all()['project_id'], true);
            $params += [
                'urlLoadTable' => 'load_table.index.schedule.projects.plans_management',
                'urlStoreSchedule' => 'store.schedule.projects.plans_management',
                'urlUpdateSchedule' => 'update.schedule.projects.plans_management',
                'urlDestroySchedule' => 'destroy.schedule.projects.plans_management'
            ];
            $response['view'] = view('business.planning.projects.schedule.loadTable', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga información de la tabla de actividades Revisión.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadTableShow(Request $request)
    {
        try {
            $params = $this->scheduleProcess->loadTable($request->all()['project_id'], true);
            $response['view'] = view('business.planning.project_review.schedule.loadTable', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacenar nueva tarea en la BD
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $this->scheduleProcess->store($request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('schedule.messages.success.created', ['element' => trans('schedule.labels.type.' . $data['type'])])
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar una actividad/tarea
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $entity = $this->scheduleProcess->update($request, true);

            $response = [
                'message' => [
                    'type' => $entity['type_message'],
                    'text' => $entity['message']
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Elimina una Tarea / Hito
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(int $id, Request $request)
    {
        $data = $request->all();
        try {
            $this->scheduleProcess->destroy($id, $request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('schedule.messages.success.deleted', ['element' => trans('schedule.labels.type.' . $data['type'])])
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Carga información para generar el diagrama de gantt.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadGantt(Request $request)
    {
        try {
            $params = $this->scheduleProcess->loadGantt($request, true);
            $params += ['urlLoadGantt' => 'load_gantt.index.schedule.projects.plans_management'];
            $response['view'] = view('business.planning.projects.schedule.loadGantt', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Carga información para generar el diagrama de gantt Revisión.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadGanttShow(Request $request)
    {
        try {
            $params = $this->scheduleProcess->loadGantt($request, true);
            $response['view'] = view('business.planning.project_review.schedule.loadGantt', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar replicar el gasto corriente.
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return JsonResponse
     */
    public function replicate(ProjectFiscalYear $projectFiscalYear)
    {
        try {
            $this->scheduleProcess->replicateLastYear($projectFiscalYear);
            return self::index($projectFiscalYear->project->id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}