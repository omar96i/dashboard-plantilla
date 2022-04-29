<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CotizacionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cotizacion;
    public $type;
    public $old_cotizacion;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cotizacion, $type, $old_cotizacion = false)
    {
        $this->cotizacion = $cotizacion;
        $this->type = $type;
        $this->old_cotizacion = $old_cotizacion;
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
