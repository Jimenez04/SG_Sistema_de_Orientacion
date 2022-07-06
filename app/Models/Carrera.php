<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
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

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function CarreraUCR()
    {
        return $this->hasOne(CarreraUCR::class);
    }
}
