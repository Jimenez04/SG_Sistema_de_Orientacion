<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActualizacionEstadoSolicitud extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $solicitud;
    public $mensaje;
    public function __construct($solicitud, $mensaje)
    {
        $this->solicitud = $solicitud;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->view('emails.request.updateStatus')->subject("Actualización de estado, solicitud de adecuación");
    }
}
