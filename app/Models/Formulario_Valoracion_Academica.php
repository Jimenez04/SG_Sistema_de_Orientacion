<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario_Valoracion_Academica extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_Curso_Rezago',  
        'id_Pregunta',
        'respuesta',

    ];

    protected $id_Curso_Rezago;
    protected $id_Pregunta;
    protected $respuesta;

    public function Curso_Rezago()
    {
        return $this->belongsTo(Curso_Rezago::class);
    }

}
