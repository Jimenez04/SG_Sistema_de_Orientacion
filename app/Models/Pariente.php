<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pariente extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'persona_cedula',
        'tipo_Pariente',
        'discapacidad_Si_Presenta', 
        'grupo_Familiar_Id ', 
    ];

    public function Grupo_Familiar()
    {
        return $this->belongsTo(Grupo_Familiar::class, 'grupo_Familiar_Id', 'id');
    }

    public function Persona()
    {
        return $this->belongsTo(Persona::class,  'persona_cedula', 'cedula');
    }
}
