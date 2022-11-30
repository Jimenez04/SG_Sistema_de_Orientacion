<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActualizacionEstadoPAI extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $solicitud;
    public $status;
    public function __construct($solicitud, $status)
    {
        $this->solicitud = $solicitud;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->view('emails.request.updateStatusPAI')->subject("Actualización de estado, solicitud PAI");
    }
}
