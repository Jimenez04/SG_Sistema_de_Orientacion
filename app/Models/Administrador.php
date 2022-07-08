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

    protected $id;
    protected $persona_cedula;
    protected $id_Rol;

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

    public function Persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function Revision_Solicitud(){
        return $this->hasMany(Revision_Solicitud::class, 'administrador_Cedula', 'persona_cedula');
    }
}


