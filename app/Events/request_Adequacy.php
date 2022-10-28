<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class request_Adequacy
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $solicitud;
    public $archivos;
    public $mensaje_Admin;
    public $mensaje_User;

    public function __construct($solicitud, $archivos)
    {
        $this->solicitud = $solicitud;
        $this->archivos = $archivos;
        $this->mensaje_Admin = "Se le informa que una nueva solicitud ha sido creada.";
        $this->mensaje_User = "Se le informa que su solicitud ha sido enviada con éxito."; 
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
