<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'id',  
        'plan__Intervencion_Id',
        'persona_Cedula',
        'relacion',
    ];

    public function Persona()
    {
        return $this->belongsTo(Persona::class, 'persona_Cedula', 'cedula');
    }
    public function Plan_Intervencion()
    {
        return $this->belongsTo(Plan_Intervencion::class, 'plan__Intervencion_Id', 'id');
    }
}
