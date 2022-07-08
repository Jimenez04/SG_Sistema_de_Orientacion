<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDeAdecuacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'razon_solicitud',
        'carrera_Empadronada',
        'carreras_simultaneas',
        'realizo_Traslado_Carrera',
        'descripcion',
        'url_Archivo_Situacion_Academica_Actual',
        'url_Archivo_Dictamen_Medico',
        'url_Archivo_Diagnostico',
        'fecha',
        'estudiante_carnet',
        'numero_solicitud '
    ];
    protected $primarykey = ['id','numero_solicitud'];
    protected $id;
    protected $numero_solicitud;
    protected $razon_Solicitud;
    protected $carrera_Empadronada;
    protected $realizo_Traslado_Carrera;
    protected $carreras_simultaneas;
    protected $descripcion;
    protected $url_Archivo_Situacion_Academica_Actual;
    protected $url_Archivo_Dictamen_Medicon;
    protected $url_Archivo_Diagnostico;
    protected $fecha;
    protected $estudiante_carnet;


  //Archivos
  public function addArhivos($arhivo)
  {
    return $this->Archivos()->save($arhivo);
  }
  public function getArhivos()
  {
    return $this->Archivos()->get()->first();
  }
  public function countArchivos()
  {
      return $this->Archivos()->count();
  }
  //EndArchivos

  //Revision_Solicitud
  public function addRevisionSolicitud($revision)
  {
    return $this->Revision_Solicitud()->save($revision);
  }
  public function getRevisionSolicitudId()
  {
    return $this->Revision_Solicitud()->get()->first()->id;
  }
  public function countRevisionSolicitud()
  {
      return $this->Revision_Solicitud()->count();
  }
  //EndRevision_Solicitud

   
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
        return $this->hasOne(Revision_Solicitud::class, 'solicitud_Numero', 'numero_solicitud');
    }
    public function Archivos(){
        return $this->hasMany(Archivos::class, 'adecuacion_Solicitud_Id', 'id');
    }
    public function Grupo_Familiar(){
        return $this->hasOne(Grupo_Familiar::class);
    }

}
