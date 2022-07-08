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


    protected $id;
    protected $persona_cedula;
    protected $tipo_Pariente;
    protected $discapacidad_Si_Presenta;
    protected $grupo_Familiar_Id ;

    public function Grupo_Familiar()
    {
        return $this->belongsTo(Grupo_Familiar::class);
    }

    public function Persona()
    {
        return $this->hasMany(Persona::class);
    }
}
