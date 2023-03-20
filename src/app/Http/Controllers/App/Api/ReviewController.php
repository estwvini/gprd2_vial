<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\App\Requests\GetReview;
use App\Http\Controllers\App\Requests\StoreReview;
use App\Http\Controllers\App\Resources\ReviewResource;
use App\Models\App\Client;
use App\Models\App\Review;
use App\Models\App\Subject;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Retrieve a collection of departments.
     *
     * @param GetReview $request
     *
     * @return JsonResponse
     */
    public function index(GetReview $request): JsonResponse
    {
        
        $type = config('api.' . $request->type);

        $reviews = Review::query()->byAuthorAndType($request->author_id, $type)->with([
            'replies' => function ($q) {
                $q->where('approved', 1);
            }
        ])->orderBy('created_at', 'desc')->get();

       
        return $this->jsonResource(ReviewResource::collection($reviews));
    }

    public function store(StoreReview $request)
    {
        $type = config('api.' . $request->type);
        $review = new Review;

        $client = Client::findOrFail($request->author_id);
        $review->author()->associate($client);
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->location_id = $request->location_id;

        $model = $type::find($request->type_id);

        $model->reviews()->save($review);

        return $this->jsonResource(new ReviewResource($review));
    }

    public function reviewsDetails(): JsonResponse
    {
        try {

            $reviews = Review::query()->join('app_subjects', function ($join) {
                $join->on('app_reviews.reviewable_id', '=', 'app_subjects.id')->where('app_reviews.reviewable_type', '=', Subject::class);;
            })->groupBy(['app_subjects.name'])
                ->selectRaw('app_subjects.name, count(*) as total')->get();

            return $this->response([$reviews]);
        } catch (Exception $ex) {
            return $this->response(['error' => '' . $ex], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
