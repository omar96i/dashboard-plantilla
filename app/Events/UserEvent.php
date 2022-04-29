<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $type;
    public $user;
    public $old_user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $type, $old_user = false)
    {
        $this->user = $user;
        $this->type = $type;
        $this->old_user = $old_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
