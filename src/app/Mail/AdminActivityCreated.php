<?php

namespace App\Mail;

use App\Models\Business\AdminActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Clase AdminActivityCreated
 *
 * @package App\Mail
 */
class AdminActivityCreated extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * Instancia de la actividad administrativa
     *
     * @var $adminActivity
     */
    protected $adminActivity;

    /**
     * Create a new message instance.
     *
     * @param AdminActivity $adminActivity
     */
    public function __construct(AdminActivity $adminActivity)
    {
        $this->adminActivity = $adminActivity;
    }

    /**
     * Construye el mensaje
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('emails.admin_activity.subject'))->view('emails.admin_activities.created')
            ->with(['activity' => $this->adminActivity]);
    }
}