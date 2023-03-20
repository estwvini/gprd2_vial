<?php

namespace App\Http\Controllers\Business\Execution;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\ScheduleProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase ScheduleBudgetaryReprogrammingController
 * @package App\Http\Controllers\Business\Execution
 */
class ScheduleBudgetaryReprogrammingController extends Controller
{

    /**
     * @var ScheduleProcess
     */
    protected $scheduleProcess;

    /**
     * Constructor ScheduleBudgetaryReprogrammingController.
     *
     * @param ScheduleProcess $scheduleProcess
     */
    public function __construct(
        ScheduleProcess $scheduleProcess
    ) {
        $this->scheduleProcess = $scheduleProcess;
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
            $params = $this->scheduleProcess->loadTable($request->all()['project_id'], false);
            $params += [
                'urlLoadTable' => 'load_table.index.schedule.budgetary.reforms.reforms_reprogramming.execution',
                'urlStoreSchedule' => 'store.schedule.budgetary.reforms.reforms_reprogramming.execution',
                'urlUpdateSchedule' => 'update.schedule.budgetary.reforms.reforms_reprogramming.execution',
                'urlDestroySchedule' => 'destroy.schedule.budgetary.reforms.reforms_reprogramming.execution'
            ];
            $response['view'] = view('business.planning.projects.schedule.loadTable', $params)->render();
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
            $data = $request->all();

            $message = $this->scheduleProcess->update($request, false);
            $response = [
                'message' => [
                    'type' => $message['type_message'],
                    'text' => $message['message']
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
     * @return Response
     */
    public function loadGantt(Request $request)
    {
        try {
            $params = $this->scheduleProcess->loadGantt($request, false);
            $params += ['urlLoadGantt' => 'load_gantt.index.schedule.budgetary.reforms.reforms_reprogramming.execution'];
            $response['view'] = view('business.planning.projects.schedule.loadGantt', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}