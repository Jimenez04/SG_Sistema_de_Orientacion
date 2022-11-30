<?php

namespace App\Listeners;

use App\Events\update_statu_PAI;
use App\Mail\ActualizacionEstadoPAI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class update_statut_PAIEmailAdmin
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
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ActualizacionEstadoPAI($event->solicitud, $event->status));
    }
}
