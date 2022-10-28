<?php

namespace App\Listeners;

use App\Events\request_Adequacy;
use App\Mail\SolicitudDeAdecuacion;
use Illuminate\Support\Facades\Mail;

class adequacyEmailAdmin
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
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new SolicitudDeAdecuacion($event->solicitud, $event->archivos,$event->mensaje_Admin));
    }
}
