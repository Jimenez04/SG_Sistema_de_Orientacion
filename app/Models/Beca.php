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

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_carnet', 'carnet');
    }

}
