<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class User_ForgetAccount
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;

    public $user_Mensaje1;
    public $user_Mensaje2;

    public function __construct($request)
    {
         $this->user_Mensaje1 = "Se le notifica que su solicitud de cambio de contraseña se ha realizado con éxito, a continuación, encontrara su nueva contraseña temporal, cámbiela cuanto antes.";
         $this->user_Mensaje2 = "En caso de no haber solicitado esta acción, favor comunicarlo con las oficinas de informática o orientación.";
        $this->data = $request;
        //dd('hola');
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
