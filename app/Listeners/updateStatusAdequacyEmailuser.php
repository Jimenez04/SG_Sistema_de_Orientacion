<?php

namespace App\Listeners;

use App\Events\update_status_Request_adequacy;
use App\Mail\ActualizacionEstadoSolicitud;
use Illuminate\Support\Facades\Mail;

class updateStatusAdequacyEmailuser
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
     * @param  \App\Events\update_status_Request_adequacy  $event
     * @return void
     */
    public function handle(update_status_Request_adequacy $event)
    {
        Mail::to($event->solicitud->Estudiante->Persona->User->email)->send(new ActualizacionEstadoSolicitud($event->solicitud, $event->mensaje));
    }
}
