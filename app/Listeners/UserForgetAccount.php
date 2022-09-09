<?php

namespace App\Listeners;

use App\Events\User_ForgetAccount;
use App\Mail\OlvideMiContrasena;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserForgetAccount
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
     * @param  \App\Events\UserForgetAccount  $event
     * @return void
     */
    public function handle(User_ForgetAccount $event)
    {
        Mail::to($event->data['email'])->send(new OlvideMiContrasena($event->data,$event->user_Mensaje1,$event->user_Mensaje2));
    }
}
