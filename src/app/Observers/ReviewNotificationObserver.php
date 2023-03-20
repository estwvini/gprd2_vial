<?php

namespace App\Observers;

use App\Mail\ReviewCreated;
use App\Models\App\Review;
use App\Models\App\Subject;
use App\Models\Business\Project;
use Illuminate\Support\Facades\Mail;


class ReviewNotificationObserver
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

        $to = null;
        $name = '';

        if ($review->reviewable instanceof Subject) {
            $to = $review->reviewable->responsible->email;
            $name = $review->reviewable->responsible->fullName();
        } elseif ($review->reviewable instanceof Project) {
            $to = $review->reviewable->responsibleUnit->managers->first()->email;
            $name = $review->reviewable->responsibleUnit->managers->first()->fullName();
        }

        if ($to) {
            Mail::to($to)->send(new ReviewCreated($name));
        }
    }
}
