<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'numero',
        'persona_cedula',
        'vida_Estudiantil_Id', 
    ];

    public function Persona()
    {
        return $this->belongsTo(Persona::class, 'persona_cedula', 'cedula');
    }

     public function Vida_Estudiantil()
    {
         return $this->hasMany(Vida_Estudiantil::class, 'vida_Estudiantil_Id', 'id');
    }
}
