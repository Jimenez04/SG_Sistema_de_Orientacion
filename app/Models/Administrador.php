<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'persona_cedula',
        'id_Rol'
    ];

    protected $id;
    protected $persona_cedula;
    protected $id_Rol;

    public function Persona()
    {
        return $this->belongsTo(Persona::class);
    }
}


