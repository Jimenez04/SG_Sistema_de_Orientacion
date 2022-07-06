<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDeAdecuacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'numero_Solicitud',
        'razon_Solicitud',
        'carrera_Empadronada',
        'carrera_Solicitada',
        'realizo_Traslado_Carrera',
        'descripcion',
        'url_Archivo_Situacion_Academica_Actual',
        'url_Archivo_Dictamen_Medico',
        'url_Archivo_Diagnostico',
        'fecha',
        'estudiante_carnet',
        'solicitud_numero',
    
    ];

    protected $id;
    protected $numero_Solicitud;
    protected $razon_Solicitud;
    protected $carrera_Empadronada;
    protected $carrera_Solicitada;
    protected $realizo_Traslado_Carrera;
    protected $descripcion;
    protected $url_Archivo_Situacion_Academica_Actual;
    protected $url_Archivo_Dictamen_Medicon;
    protected $url_Archivo_Diagnostico;
    protected $fecha;
    protected $estudiante_carnet;
    protected $solicitud_numero;


   
    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
    public function Necesidad_Y_Apoyo()
    {
        return $this->hasOne(Necesidad_Y_Apoyo::class);
    }
    public function Institucion_Procedencia()
    {
        return $this->hasOne(Institucion_Procedencia::class);
    }
    public function Revision_Solicitud()
    {
        return $this->hasOne(Revision_Solicitud::class);
    }
    public function Archivos(){
        return $this->hasMany(Archivos::class);
    }
    public function Grupo_Familiar(){
        return $this->hasOne(Grupo_Familiar::class);
    }

}
