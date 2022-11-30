<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class requestPAI extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */ 
    public $solicitud;
    public $archivos;
    public $mensaje;

    public function __construct($solicitud, $archivos, $mensaje)
   {
       $this->solicitud = $solicitud;
       $this->archivos = $archivos;
       $this->mensaje = $mensaje;
   }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('emails.request.newPAI')->subject("Notificación, nueva Solicitud PAI");
        foreach ($this->archivos as $archivo) {
            $this->attachData($archivo['pdf'], $archivo['nombre']);
        }
        return $this;
    }
}
