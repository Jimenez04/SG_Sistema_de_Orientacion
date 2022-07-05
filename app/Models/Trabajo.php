<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;

protected $fillable = [
    'id_trabajo',
    'trabajo_Actual',
    'actividad_Que_Desempena',
    'lugar_De_Trabajo',
    'jornada_Trabajo',
    'horario_Laboral',
];

    protected $id_trabajo;
    protected $trabajo_Actual;
    protected $actividad_Que_Desempena;
    protected $lugar_De_Trabajo;
    protected $jornada_Trabajo;
    protected $horario_Laboral;

    public function Persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
