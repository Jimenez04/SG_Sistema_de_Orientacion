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

    protected $id;
    protected $plan__Intervencion_Id;
    protected $persona_Cedula;
    protected $relacion;

    public function Persona()
    {
        return $this->belongsTo(Persona::class);
    }
    public function Plan_Intervencion()
    {
        return $this->hasMany(Plan_Intervencion::class);
    }
}
