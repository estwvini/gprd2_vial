<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\Planning\Prioritization;
use App\Processes\Business\Planning\PrioritizationProcess;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase PrioritizationController
 * @package App\Http\Controllers\Business\Planning
 */
class PrioritizationController extends Controller
{
    /**
     * @var PrioritizationProcess
     */
    protected $prioritizationProcess;

    /**
     * Constructor de PrioritizationController.
     *
     * @param PrioritizationProcess $prioritizationProcess
     */
    public function __construct(
        PrioritizationProcess $prioritizationProcess
    ) {
        $this->prioritizationProcess = $prioritizationProcess;
    }

    /**
     * Desplegar lista de proyectos a priorizar.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.index',
                $this->prioritizationProcess->index()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables.
     *
     * @return JsonResponse
     */
    public function data()
    {
        try {
            return $this->prioritizationProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de priorización de proyecto.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.create',
                $this->prioritizationProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para gestionar las acciones de priorización de proyecto.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function handle(Request $request)
    {
        try {
            $nextAction = $this->prioritizationProcess->handle($request->id);

            switch ($nextAction) {
                case Prioritization::ACTION_CREATE:
                    $response = self::create($request);
                    break;
                case Prioritization::ACTION_EDIT:
                    $response = self::edit($request->id);
                    break;
                case Prioritization::ACTION_SHOW:
                    $response = self::show($request->id);
                    break;
                default:
                    throw new Exception(trans('prioritization.messages.exceptions.action_not_found'), 1000);
            }

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return $response;
    }

    /**
     * Llamada al proceso para almacenar nueva priorización del proyecto seleccionado.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */

    public function store(Request $request)
    {
        try {
            $this->prioritizationProcess->store($request);

            $response = [
                'view' => view('business.planning.projects.prioritization.index',
                    $this->prioritizationProcess->index()
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('prioritization.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de priorización del proyecto seleccionado.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.show',
                $this->prioritizationProcess->show($id)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de priorización del proyecto seleccionado.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.update',
                $this->prioritizationProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de priorización del proyecto seleccionado.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $this->prioritizationProcess->update($request, $id);

            $response = [
                'view' => view('business.planning.projects.prioritization.index',
                    $this->prioritizationProcess->index()
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('prioritization.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar priorización del proyecto seleccionado.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->prioritizationProcess->destroy($id);

            $response = [
                'view' => view('business.planning.projects.prioritization.index',
                    $this->prioritizationProcess->index()
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('prioritization.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}