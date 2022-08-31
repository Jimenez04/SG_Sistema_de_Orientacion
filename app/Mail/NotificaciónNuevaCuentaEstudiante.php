<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificaciónNuevaCuentaEstudiante extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $data;
     public $mensaje1;
     public $mensaje2;

    public function __construct($request, $mensaje1, $mensaje2)
    {
        $this->data = $request;
        $this->mensaje1 = $mensaje1;
        $this->mensaje2 = $mensaje2;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.account_created');
    }
}
