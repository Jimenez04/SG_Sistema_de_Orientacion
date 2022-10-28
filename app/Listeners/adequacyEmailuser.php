<?php

namespace App\Listeners;

use App\Events\request_Adequacy;
use App\Mail\SolicitudDeAdecuacion;
use App\Mail\solicitudesAdecuacion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class adequacyEmailuser
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
     * @param  \App\Events\request_Adequacy  $event
     * @return void
     */
    public function handle(request_Adequacy $event)
    {
        Mail::to($event->solicitud->Estudiante->Persona->User->email)->send(new SolicitudDeAdecuacion($event->solicitud, $event->archivos, $event->mensaje_User));;
    }
}
