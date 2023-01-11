<?php

namespace App\Listeners;

use App\Events\request_PAI;
use App\Mail\requestPAI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class request_PAIEmailAdmin
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
        if(env('APP_ENV' == 'local')){
            Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new requestPAI($event->solicitud, $event->archivos,$event->mensaje_Admin));  
        }else if(env('APP_ENV' == 'production')){
            Mail::to(env('MAIL_FROM_ADDRESS'))
            ->cc(['orientacion.sg@ucr.ac.cr','vidaestudiantil.sg@ucr.ac.cr'])
            ->send(new requestPAI($event->solicitud, $event->archivos,$event->mensaje_Admin));   
        }
    }
}
