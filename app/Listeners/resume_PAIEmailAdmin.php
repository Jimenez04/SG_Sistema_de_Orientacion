<?php

namespace App\Listeners;

use App\Events\resume_PAI;
use App\Mail\resumePAI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class resume_PAIEmailAdmin
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
     * @param  \App\Events\resume_PAI  $event
     * @return void
     */
    public function handle(resume_PAI $event)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))
        //->cc(['orientacion.sg@ucr.ac.cr','vidaestudiantil.sg@ucr.ac.cr'])
       // ->cc(['jose.040199@gmail.com','jose.040199@hotmail.com'])
       ->send(new resumePAI($event->solicitud, $event->archivos,$event->mensaje_Admin));
    }
}
