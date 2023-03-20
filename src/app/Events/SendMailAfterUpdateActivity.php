<?php

namespace App\Events;

use App\Models\Business\AdminActivity;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMailAfterUpdateActivity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $adminActivity;

    /**
     * Create a new event instance.
     *
     * @param AdminActivity $adminActivity
     */
    public function __construct(AdminActivity  $adminActivity)
    {
        $this->adminActivity = $adminActivity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
