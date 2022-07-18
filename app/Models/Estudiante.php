<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'carnet',
        'persona_cedula',
        'id_Rol',
        'ano_Ingreso',
        'profesor_Consejero',
    ];

    protected $primaryKey = 'carnet';

    //Beca
    public function addbeca($beca)
    {
      return $this->Beca()->save($beca);
    }
    public function getBeca()
    {
      return $this->Beca()->get()->first()->id;
    }
    //endbeca
    
    //carreras
    public function addcarrera($carrera)
    {
      return $this->Carrera()->save($carrera);
    }
    public function getcarrera()
    {
      return $this->Carrera()->get()->first();
    }
    public function countCarrera()
    {
        return $this->Carrera()->count();
    }

    //endbendcarreras

    //SolicitudDeAdecuacion
    public function addSolicitudAdecuacion($carrera)
    {
      return $this->SolicitudDeAdecuacion()->save($carrera);
    }
    public function getSolicitudAdecuacion()
    {
      return $this->SolicitudDeAdecuacion()->get()->first();
    }
    public function countSolicitudAdecuacion()
    {
        return $this->SolicitudDeAdecuacion()->count();
    }
    //EndSolicitudDeAdecuacion


        //SolicitudPAI
        public function addSolicitudPAI($carrera)
        {
          return $this->SolicitudPAI()->save($carrera);
        }
        public function getSolicitudPAI()
        {
          return $this->SolicitudPAI()->get()->first();
        }
        public function countSolicitudPAI()
        {
            return $this->SolicitudPAI()->count();
        }
        //EndSolicitudDeAdecuacion


        //  relaciones
        public function Beca()
        { 
          return $this->hasOne(Beca::class, 'estudiante_carnet', 'carnet');	
        }
        
        public function Carrera()
        {
          return $this->hasMany(Carrera::class, 'estudiante_carnet', 'carnet');
    }
    public function SolicitudDeAdecuacion()
    {
      return $this->hasMany(SolicitudDeAdecuacion::class, 'estudiante_carnet', 'carnet');
    }
    public function SolicitudPAI()
    {
      return $this->hasMany(Plan_De_Accion_Individual::class, 'estudiante_Carnet', 'carnet');
    }
    public function Persona()
    {
        return $this->belongsTo(Persona::class, 'persona_cedula', 'cedula');	
    }
  }
