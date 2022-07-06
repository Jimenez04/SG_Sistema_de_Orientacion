<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'id',  
        'id_Plan_Intervencion',
        'cedula',
        'relacion',

    ];

    protected $id;
    protected $id_Plan_Intervencion;
    protected $cedula;
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
