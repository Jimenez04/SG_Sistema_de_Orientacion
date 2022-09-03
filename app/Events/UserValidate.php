<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserValidate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;

    public $admin_Mensaje1;
    public $Admin_Mensaje2;

    public $user_Mensaje1;
    public $user_Mensaje2;

    public function __construct($request)
    {
         $this->admin_Mensaje1 = "Se le notifica que ha completado el proceso de validación de la cuenta asociada a:" . $request->Persona['nombre1'] . " " .  $request->Persona['nombre2'] . ", carnet: " . $request->Persona->Estudiante->carnet_S . ".";
         $this->Admin_Mensaje2 = "Si usted no realizo dicha acción, comuníquese con las oficinas de informática.";

         $this->user_Mensaje1 = "Se le notifica que su cuenta ha sido validada, ya puede disfrutar de los beneficios que ofrece la oficina de orientación.";
         $this->user_Mensaje2 = "Ante cualquier consulta, puede llamar directamente a las oficinas de orientación, o bien, asistir de forma presencial.";
        $this->data = $request;
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
