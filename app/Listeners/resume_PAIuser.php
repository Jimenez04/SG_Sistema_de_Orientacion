<?php

namespace App\Listeners;

use App\Events\resume_PAI;
use App\Mail\resumePAI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class resume_PAIuser
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
    }
}
