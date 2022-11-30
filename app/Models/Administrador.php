<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'persona_cedula',
        'id_Rol'
    ];
    protected $primaryKey = 'id';


     //Revision_Solicitud
  public function addRevision($revision)
  {
    return $this->Revision_Solicitud()->save($revision);
  }
  public function getRevisionSolicitud()
  {
    return $this->Revision_Solicitud()->get()->first();
  }
  public function countRevision()
  {
      return $this->Revision_Solicitud()->count();
  }
  //EndRevision_Solicitud


  //relaciones
  
  public function Revision_Solicitud(){
      return $this->hasMany(Revision_Solicitud::class, 'administrador_Id', 'id');
    }
    
    public function PlanDeAccionIndividual()
    {
        return $this->hasMany(Plan_De_Accion_Individual::class, 'administrador_Id', 'id');	
    }
    public function Persona()
    {
        return $this->belongsTo(Persona::class,'persona_cedula', 'cedula');
    }
}


