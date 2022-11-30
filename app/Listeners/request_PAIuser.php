<?php

namespace App\Listeners;

use App\Events\request_PAI;
use App\Mail\requestPAI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class request_PAIuser
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
     * @param  \App\Events\request_PAI  $event
     * @return void
     */
    public function handle(request_PAI $event)
    {
        Mail::to($event->solicitud->Estudiante->Persona->User->email)->send(new requestPAI($event->solicitud, $event->archivos, $event->mensaje_User));
    }
}
