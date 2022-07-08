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
    
    protected $id;
    protected $ano_Ingreso;
    protected $nivel_Carrera;
    protected $estado;
    protected $orden;
    protected $estudiante_carnet ;
    protected $carrera_id;

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function CarreraUCR()
    {
        return $this->hasOne(CarreraUCR::class, 'id', 'carrera_id');
    }
    
}
