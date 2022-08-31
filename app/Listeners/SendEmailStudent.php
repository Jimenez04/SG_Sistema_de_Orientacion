<?php

namespace App\Listeners;

use App\Events\StudentSaved;
use App\Mail\NotificaciónNuevaCuentaEstudiante;
use Illuminate\Support\Facades\Mail;

class SendEmailStudent
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
     * @param  \App\Events\StudentSaved  $event
     * @return void
     */
    public function handle(StudentSaved $event)
    {
        $mensaje1 = "Se le notifica que su cuenta ha sido creada con éxito, pero aún no esta habilitada, la cuenta será habilitada en un periodo de 1 a 3 días hábiles. Dentro de poco podrá realizar sus solicitudes en la oficina de orientación de forma virtual.";
        $mensaje2 = "Si la información es incorrecta, por favor contactar con la oficina de orientación o ir presencialmente, ya que, esto afectara en el proceso de validación de su cuenta.";
        Mail::to($event->data['email'])->send(new NotificaciónNuevaCuentaEstudiante($event->data,$mensaje1,$mensaje2));
    }
}
