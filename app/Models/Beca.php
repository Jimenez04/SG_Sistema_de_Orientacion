<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_Beca',
        'estudiante_carnet',
        'categoria_Beca',
        'asistencia_Socieoeconomica',
        'participacion',
    ];


    protected $id_Beca;
    protected $estudiante_carnet;
    protected $categoria_Beca;
    protected $asistencia_Socieoeconomica;
    protected $participacion;

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

}
