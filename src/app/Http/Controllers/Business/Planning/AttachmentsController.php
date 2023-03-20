<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\AttachmentsProcess;
use App\Processes\System\FileProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase AttachmentsController
 * @package App\Http\Controllers\Business\Planning
 */
class AttachmentsController extends Controller
{
    /**
     * @var AttachmentsProcess
     */
    protected $attachmentsProcess;

    /**
     * @var FileProcess
     */
    protected $fileProcess;

    /**
     * Constructor de AttachmentsController.
     *
     * @param AttachmentsProcess $attachmentsProcess
     * @param FileProcess $fileProcess
     */
    public function __construct(
        AttachmentsProcess $attachmentsProcess,
        FileProcess $fileProcess
    ) {
        $this->attachmentsProcess = $attachmentsProcess;
        $this->fileProcess = $fileProcess;
    }

    /**
     * Llamada al proceso para mostrar el formulario de subida de anexos.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $response['modal'] = view('business.planning.attachments.create',
                $this->attachmentsProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de subida de anexos.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function indexShow(Request $request)
    {
        try {
            $response['modal'] = view('business.planning.project_review.attachments.create',
                $this->attachmentsProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario para visualizar anexos viales.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function attachmentsRoadsShow(Request $request)
    {
        try {
            $response['modal'] = view('business.planning.project_review.attachments_roads.create',
                $this->attachmentsProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevos anexos del proyecto seleccionado.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */

    public function store(Request $request)
    {
        try {
            $data = $this->attachmentsProcess->store($request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => $data[1]
                ]
            ];
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
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
     * Llamada al proceso para eliminar lógicamente un anexo.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            $response = [
                'view' => view('business.planning.attachments.partial.inputs', $this->attachmentsProcess->destroy($request))->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('attachments.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de subida de anexos viales.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createRoads(Request $request)
    {
        try {
            $response['modal'] = view('business.planning.attachments_roads.create',
                $this->attachmentsProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de subida de anexos viales.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function indexShowRoads(Request $request)
    {
        try {
            $response['modal'] = view('business.planning.project_review.attachments_roads.create',
                $this->attachmentsProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar anexos viales del proyecto seleccionado.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeRoads(Request $request)
    {
        try {
            $data = $this->attachmentsProcess->storeRoads($request);
            $response = [
                'message' => [
                    'type' => $data[2],
                    'text' => $data[1]
                ]
            ];
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para descargar un anexo vial.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function downloadRoads(int $id)
    {
        try {
            return $this->fileProcess->download($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar lógicamente un anexo vial.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroyRoads(Request $request)
    {
        try {
            $response = [
                'view' => view('business.planning.attachments_roads.partial.inputs', $this->attachmentsProcess->destroy($request))->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('attachments.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}