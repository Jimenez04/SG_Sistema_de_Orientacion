<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class SolicitudDeAdecuacion extends Mailable
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
        $this->view('emails.request.newAdequacy');
        //$this->view('adequacy');
        foreach ($this->archivos as $archivo) {
            $this->attachData($archivo['pdf'], $archivo['nombre']);
        }
        // $this->attachData($this->archivo_solicitud->output(),"Hola.pdf");
        return $this;
    }
}
