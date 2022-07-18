<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario_Valoracion_Academica extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_Rezago_Id',  
        'pregunta_Id',
        'respuesta',

    ];
    protected $primaryKey = ['curso_Rezago_Id', 'pregunta_Id'];



    public function Curso_Rezago()
    {
        return $this->belongsTo(Curso_Rezago::class, 'curso_Rezago_Id', 'id');
    }
    public function Preguntas_Valoracion()
    {
        return $this->belongsTo(Preguntas_Valoracion::class, 'pregunta_Id', 'id');
    }

}
