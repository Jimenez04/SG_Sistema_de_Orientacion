<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Necesidad_Y_Apoyo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'solicitud_Numero',
        'diagnostico',
        'profesional_Que_Diagnostica',
        'area_Profesional',
        'descripcion_Seguimiento',
        'descripcion_Atencion',
    ];

    public function add_($numSolicitud, $request)
    {
        $necesidad = new Necesidad_Y_Apoyo($request['necesidad_Apoyo']);
            if(SolicitudDeAdecuacion::where('numero_solicitud', $numSolicitud)->exists()){
                $solicitud = (SolicitudDeAdecuacion::where('numero_solicitud', $numSolicitud)->first());
                $solicitud->addRNecesidadY_Apoyo($necesidad);
              return ['status' => true, 'message' => 'Creada correctamente'];
            }else{
                return ['status' => false, 'message' => 'Error interno'];
            }
    }

    public function SolicitudDeAdecuacion()
    {
        return $this->belongsTo(SolicitudDeAdecuacion::class, 'solicitud_Numero', 'numero_solicitud');	
    }
}
