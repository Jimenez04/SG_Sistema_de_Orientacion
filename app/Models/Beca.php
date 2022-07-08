<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'estudiante_carnet',
        'categoria_Beca',
        'asistencia_Socioeconomica',
        'participacion',
    ];

    protected $id;
    protected $estudiante_carnet;
    protected $categoria_Beca;
    protected $asistencia_Socioeconomica;
    protected $participacion;

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

}
