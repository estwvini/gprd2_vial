<?php

namespace App\Mail;

use App\Models\App\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ReviewCreated extends Mailable
{
    use Queueable, SerializesModels;


    protected $responsible;

    public function __construct(string $responsible)
    {
        $this->responsible = $responsible;
    }

    public function build()
    {
        return $this->subject(trans('emails.review.subject'))->view('emails.reviews.created')
            ->with(['responsible' => $this->responsible]);
    }
}