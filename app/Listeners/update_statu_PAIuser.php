<?php

namespace App\Listeners;

use App\Events\update_statu_PAI;
use App\Mail\ActualizacionEstadoPAI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class update_statu_PAIuser
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
     * @param  \App\Events\update_statu_PAI  $event
     * @return void
     */
    public function handle(update_statu_PAI $event)
    {
        Mail::to($event->solicitud->Estudiante->Persona->User->email)->send(new ActualizacionEstadoPAI($event->solicitud, $event->status));
    }
}
