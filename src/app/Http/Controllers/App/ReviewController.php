<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\App\Review;
use App\Processes\App\ReviewProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ReviewController
 * @package App\Http\Controllers\App
 */
class ReviewController extends Controller
{
    /**
     * @var ReviewProcess
     */
    private $reviewProcess;

    /**
     * Constructor de ReviewController.
     *
     * @param ReviewProcess $reviewProcess
     */
    public function __construct(ReviewProcess $reviewProcess)
    {
        $this->middleware('route')->only('index');
        $this->reviewProcess = $reviewProcess;
    }

    /**
     * Desplegar lista de comentarios.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response['view'] = view('app.reviews.index')->render();
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
    public function data()
    {
        try {
            return $this->reviewProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(Review $review)
    {
        try {
            $response['modal'] = view('app.reviews.create', ['review' => $review])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Almacenar una respuesta a comentario
     *
     * @param Request $request
     * @param Review $review
     *
     * @return JsonResponse
     */
    public function store(Request $request, Review $review): JsonResponse
    {
        try {
            $response = new Review;
            $response->author()->associate(currentUser());
            $response->comment = $request->comment;
            $response->parent()->associate($review);

            $review->reviewable->reviews()->save($response);

            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('app/reviews.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }
}
