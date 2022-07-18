<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'estudiante_carnet',
        'carrera_id',
        'ano_Ingreso',
        'nivel_Carrera',
        'estado',
        'orden',
    ];

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_carnet', 'carnet');
    }

    public function CarreraUCR()
    {
        return $this->belongsTo(CarreraUCR::class, 'carrera_id', 'id');
    }
    
}
