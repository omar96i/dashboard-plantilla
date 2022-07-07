<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProyectoEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $proyecto;
    public $type;
    public $old_proyecto;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($proyecto, $type, $old_proyecto = false)
    {
        $this->proyecto = $proyecto;
        $this->type = $type;
        $this->old_proyecto = $old_proyecto;
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
