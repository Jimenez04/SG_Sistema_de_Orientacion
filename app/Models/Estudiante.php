<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'carnet',
        'id_Rol',
        'ano_Ingreso',
        'profesor_Consejero',
    ];

    protected $carnet;
    protected $id_Rol;
    protected $ano_Ingreso;
    protected $profesor_Consejero;

    public function Persona()
    {
        return $this->hasOne(Persona::class);
    }
    public function Beca()
    { 
        return $this->hasOne(Beca::class);
    }
}
