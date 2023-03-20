<?php

namespace App\Listeners;

use App\Events\SendMailAfterUpdateActivity;
use App\Models\Business\AdminActivity;
use App\Models\System\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailCompleteActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SendMailAfterUpdateActivity $event
     * @return void
     */
    public function handle(SendMailAfterUpdateActivity $event)
    {
        $adminActivity = $event->adminActivity;
        $user = $adminActivity->author;
        $createdBy = $user->fullNameWithLastNameFirst();
        $directors = $adminActivity->responsibleUnit->managers()->get();
        foreach ($directors as $director) {

            if ($director->email != null) {
                $response = [
                    'entity' => $adminActivity,
                    'createdBy' => $createdBy,
                    'director' => $director
                ];
                $directorEmail = $director->email;
                Mail::send('emails.admin_activities.updated', $response, function ($message) use ($response, $directorEmail) {
                    $message->to($directorEmail);
                    $message->subject(trans('admin_activities.labels.Administrative_Activity_Completed'));
                });
            }
        }

    }
}
