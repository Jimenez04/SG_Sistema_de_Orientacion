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
    protected $carnet;
    protected $persona_cedula;
    protected $id_Rol;
    protected $ano_Ingreso;
    protected $profesor_Consejero;



    //Beca
    public function addbeca($beca)
    {
      return $this->Beca()->save($beca);
    }
    public function getBeca()
    {
      return $this->Beca()->get()->first();
    }

    //endbeca

    //Beca
    public function addcarrera($carrera)
    {
      return $this->Carrera()->save($carrera);
    }
    public function getcarrera()
    {
      return $this->Carrera()->get()->first();
    }

    //endbeca


    public function Persona()
    {
        return $this->belongsTo(Persona::class);	
    }
    public function Beca()
    { 
        return $this->hasOne(Beca::class, 'estudiante_carnet', 'carnet');	
    }

    public function Carrera()
    {
        return $this->hasMany(Carrera::class, 'estudiante_carnet', 'carnet');
    }
}
