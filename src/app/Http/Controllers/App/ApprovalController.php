<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\App\Review;
use App\Processes\App\ApprovalProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ApprovalController
 * @package App\Http\Controllers\App
 */
class ApprovalController extends Controller
{

    /**
     * @var ApprovalProcess
     */
    private $approvalProcess;

    /**
     * Constructor de ReviewController.
     *
     * @param ApprovalProcess $approvalProcess
     */
    public function __construct(ApprovalProcess $approvalProcess)
    {
        $this->middleware('route')->only('index');
        $this->approvalProcess = $approvalProcess;
    }

    /**
     * Desplegar lista de comentarios.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response['view'] = view('app.approvals.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @return JsonResponse|string
     */
    public function data(Request $request)
    {
        try {
            return $this->approvalProcess->data($request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    public function edit(Review $review)
    {
        try {
            $response['modal'] = view('app.approvals.edit', ['review' => $review])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    public function update(Request $request, Review $review)
    {
        try {
            $review->comment = $request->input('comment');
            $review->save();
            $response['message'] = [
                'type' => 'success',
                'text' => trans('app/reviews.messages.success.updated')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    public function bulkApprove(Request $request): JsonResponse
    {
        try {
            $this->approvalProcess->bulkApprove($request->ids);
            $response['message'] = [
                'type' => 'success',
                'text' => trans('app/reviews.messages.success.updated_bulk')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
