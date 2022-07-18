<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;

protected $fillable = [
    'id',
    'trabajo_Actual',
    'actividad_Que_Desempena',
    'lugar_De_Trabajo',
    'jornada_Trabajo',
    'horario_Laboral',
];

    public function Persona()
    {
        return $this->hasOne(Persona::class, 'trabajo_id', 'id');
    }

    public function addperson($persona){
        $this->Persona()->save($persona);
    }
}
