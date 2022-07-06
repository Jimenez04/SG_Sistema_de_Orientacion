<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'persona_cedula',
        'tipo_Enfermedad',
        'descripcion',
        'tratamiento',
        'rutina_Tratamiento',
    ];

    protected $id;
    protected $persona_cedula;
    protected $tipo_Enfermedad;
    protected $descripcion;
    protected $tratamiento;
    protected $rutina_Tratamiento;

    public function Persona()
    {
        return $this->belongsTo(Persona::class);	
    }
}
