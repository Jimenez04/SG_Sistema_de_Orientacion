<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoUCR extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'carrera_id',
        'nombre',
        'creditos', 
    ];

    protected $id;
    protected $id_Carrera;
    protected $nombre;
    protected $creditos;

    public function carrera_UCR()
    {
        return $this->belongsTo(Persona::class);
    }

    // public function Curso_Rezago()
    // {
    //     return $this->hasOne(Curso_Rezago::class);
    // }
}
