<?php

namespace App\Listeners;

use App\Events\UserValidate;
use App\Mail\NotificacionValidacionDeCuenta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ValidateSendEmailUser
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
     * @param  \App\Events\UserValidate  $event
     * @return void
     */
    public function handle(UserValidate $event)
    {
        Mail::to($event->data['email'])->send(new NotificacionValidacionDeCuenta($event->data,$event->user_Mensaje1,$event->user_Mensaje2));
    }
}
