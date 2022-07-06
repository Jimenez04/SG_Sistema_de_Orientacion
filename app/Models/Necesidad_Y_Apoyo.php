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
    ];

    protected $id;
    protected $solicitud_Numero;
    protected $diagnostico;
    protected $profesional_Que_Diagnostica;
    protected $area_Profesional;

    public function SolicitudDeAdecuacion()
    {
        return $this->belongsTo(SolicitudDeAdecuacion::class);	
    }
    public function Seguimiento()
    { 
        return $this->hasOne(Seguimiento::class);
    }
}
