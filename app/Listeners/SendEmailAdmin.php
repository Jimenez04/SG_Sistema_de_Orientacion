<?php

namespace App\Listeners;

use App\Events\StudentSaved;
use App\Mail\NotificacionNuevaCuentaEstudiante;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAdmin
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
        $mensaje1 = "Un nuevo usuario ha sido registrado en el sistema, a continuación, un resumen de la información.";
        $mensaje2 = "Se le solicita verificar la cuenta lo antes posible.";
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NotificacionNuevaCuentaEstudiante($event->data,$mensaje1,$mensaje2));
        //Mail::to('ISAAC.JIMENEZALFARO@ucr.ac.cr')->send(new NotificaciónNuevaCuentaEstudiante($event->data,$mensaje1,$mensaje2));
    }
}
