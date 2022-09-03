<?php

namespace App\Listeners;

use App\Events\UserValidate;
use App\Mail\NotificacionValidacionDeCuenta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ValidateSendEmailAdmin
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
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NotificacionValidacionDeCuenta($event->data,$event->admin_Mensaje1,$event->Admin_Mensaje2));
    }
}
