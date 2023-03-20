<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\PrioritizationTemplateProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase PrioritizationTemplateController
 * @package App\Http\Controllers\Business\Planning
 */
class PrioritizationTemplateController extends Controller
{
    /**
     * @var PrioritizationTemplateProcess
     */
    protected $prioritizationTemplateProcess;

    /**
     * Constructor de PrioritizationTemplateController.
     *
     * @param PrioritizationTemplateProcess $prioritizationTemplateProcess
     */
    public function __construct(
        PrioritizationTemplateProcess $prioritizationTemplateProcess
    ) {
        $this->prioritizationTemplateProcess = $prioritizationTemplateProcess;
    }

    /**
     * Desplegar lista de templates.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.templates.index')->render();
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
            return $this->prioritizationTemplateProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de template.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.templates.create',
                $this->prioritizationTemplateProcess->create()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevo template.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */

    public function store(Request $request)
    {
        try {
            $this->prioritizationTemplateProcess->store($request);

            $response = [
                'view' => view('business.planning.projects.prioritization.templates.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('prioritization_templates.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de template.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.templates.update',
                $this->prioritizationTemplateProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de template.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->prioritizationTemplateProcess->update($request, $id);

            $response = [
                'view' => view('business.planning.projects.prioritization.templates.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('prioritization_templates.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de template.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $response['view'] = view('business.planning.projects.prioritization.templates.show',
                $this->prioritizationTemplateProcess->show($id)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar template.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->prioritizationTemplateProcess->destroy($id);

            $response = [
                'view' => view('business.planning.projects.prioritization.templates.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('prioritization_templates.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}