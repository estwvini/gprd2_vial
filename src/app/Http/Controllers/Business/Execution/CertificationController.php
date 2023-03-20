<?php

namespace App\Http\Controllers\Business\Execution;

use App\Http\Controllers\Controller;
use App\Models\Business\AdminActivity;
use App\Processes\Business\Execution\AdminActivityProcess;
use App\Processes\Business\Execution\CertificationProcess;
use App\Processes\System\FileProcess;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

/**
 * Clase CertificationController
 *
 * @package App\Http\Controllers\Business\Execution
 */
class CertificationController extends Controller
{
    /**
     * @var CertificationProcess
     */
    private $certificationProcess;

    /**
     * Constructor CertificationController.
     *
     * @param CertificationProcess $certificationProcess
     */
    public function __construct(CertificationProcess $certificationProcess)
    {
        $this->certificationProcess = $certificationProcess;
    }

    /**
     * Listar certificaciones en revisión
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response['view'] = view('business.execution.certifications.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Listar certificaciones aprobadas
     *
     * @return JsonResponse
     */
    public function indexApproved(): JsonResponse
    {
        try {
            $response['view'] = view('business.execution.certifications.index_approved')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Listar certificaciones de un proyecto
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function projectIndex(int $projectId): JsonResponse
    {
        try {
            $response['view'] = view('business.execution.certifications.project.index', ['projectId' => $projectId])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de certificaciones
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function data(Request $request)
    {
        try {
            return $this->certificationProcess->data($request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Crear certificaiones
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function create(int $projectId): JsonResponse
    {
        try {
            $response['modal_xl'] = view('business.execution.certifications.project.create', $this->certificationProcess->dataCreate($projectId))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Retorna una item según la actividad
     *
     * @param int $activityId
     * @param int|null $id
     *
     * @return JsonResponse
     */
    public function items(int $activityId, int $id = null): JsonResponse
    {
        try {
            $response['view'] = view('business.execution.certifications.partials.items', ['items' => $this->certificationProcess->items($activityId, $id)])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }


    /**
     * Editar certificaciones
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        try {
            $response['modal_xl'] = view('business.execution.certifications.project.update', $this->certificationProcess->dataEdit($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacenar nueva certificación
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function store(Request $request, int $id): JsonResponse
    {
        try {
            $this->certificationProcess->store($request->all());
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('certifications.messages.success.created'),
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar una certificaión
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->certificationProcess->update($id, $request->all());
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('certifications.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return $response;
    }

    /**
     * Ver Detalles de una certificaión
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $response['modal_xl'] = view('business.execution.certifications.show', $this->certificationProcess->dataEdit($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Aprobar una certificaión
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(Request $request, int $id): JsonResponse
    {
        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('certifications.messages.success.approved')
            ]
        ];
        try {
            $this->certificationProcess->status($id, $request->input('status'), $request->input('user_id'));
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
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
     * Llamada al proceso para guardar un comentario
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function storeComment(Request $request, int $id): JsonResponse
    {
        try {
            $entity = $this->certificationProcess->storeComment($id, $request->all());
            $response = [
                'view' => view('business.execution.certifications.partials.comments-list', ['entity' => $entity])->render(),
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
     * Ver Detalles de una certificaión dentro del proyecto
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function showInProject(int $id): JsonResponse
    {
        try {
            $response['modal_xl'] = view('business.execution.certifications.project.show', $this->certificationProcess->dataEdit($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }


    /**
     * Exporta las certificaciones aprobadas en un documento PDF
     *
     *
     * @param int $id
     * @return string|BinaryFileResponse
     */
    public function generatePdf(int $id)
    {
        try {
            $data = $this->certificationProcess->dataEdit($id);
            $pdf = PDF::loadView('business/execution/certifications/partials/pdfFormat', $data);
            return $pdf->download(trans('certifications.pdf.title') . '.pdf');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Ver Detalles de una certificaión
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function showPoa(int $id): JsonResponse
    {
        try {
            $response['modal_xl'] = view('business.execution.certifications.showPoa', $this->certificationProcess->dataEdit($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}