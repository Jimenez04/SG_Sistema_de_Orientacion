<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion_Procedencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'ano_egreso',
        'solicitud_Numero',
    ];

    public function add_($numSolicitud, $request)
    {
        $institucion = new Institucion_Procedencia($request['institucion']);
            if(SolicitudDeAdecuacion::where('numero_solicitud', $numSolicitud)->exists()){
                $solicitud = (SolicitudDeAdecuacion::where('numero_solicitud', $numSolicitud)->first());
                $solicitud->addInstitucion($institucion);
              return ['status' => true, 'message' => 'Creado correctamente'];
            }else{
                return ['status' => false, 'message' => 'Error interno'];
            }
    }

    public function SolicitudDeAdecuacion()
    {
        return $this->belongsTo(SolicitudDeAdecuacion::class, 'solicitud_Numero', 'numero_solicitud');
    }
}
