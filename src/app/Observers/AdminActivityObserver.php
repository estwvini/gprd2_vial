<?php

namespace App\Observers;

use App\Events\SendMailAfterUpdateActivity;
use App\Mail\AdminActivityCreated;
use App\Models\Business\AdminActivity;
use Illuminate\Support\Facades\Mail;

/**
 * Clase AdminActivityObserver
 *
 * @package App\Observers
 */
class AdminActivityObserver
{

    /**
     * Handle the AdminActivity "created" event.
     *
     * @param AdminActivity $activity
     *
     * @return void
     */
    public function created(AdminActivity $activity)
    {
        if ($activity->assigned->email) {
            Mail::to($activity->assigned->email)->send(new AdminActivityCreated($activity));
        }

        if ($activity->status && $activity->status == AdminActivity::STATUS_COMPLETED) {
            \event(new SendMailAfterUpdateActivity($activity));
        }
    }
}
