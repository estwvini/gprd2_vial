<?php

namespace App\Observers;

use App\Mail\ReviewCreated;
use App\Models\App\Review;
use App\Models\App\Subject;
use App\Models\Business\Project;
use Illuminate\Support\Facades\Mail;


class ReviewResponseObserver
{

    /**
     * Handle the Review "created" event.
     *
     * @param Review $review
     *
     * @return void
     */
    public function created(Review $review)
    {

        if ($review->parent_id) {
            return;
        }

        $response = new Review;
        $response->comment = trans('app/reviews.messages.info.default_response');
        $response->approved = 1;
        $response->parent()->associate($review);

        $review->reviewable->reviews()->save($response);
    }
}
