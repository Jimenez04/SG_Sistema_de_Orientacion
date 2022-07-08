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

    protected $curso_Rezago_Id;
    protected $pregunta_Id;
    protected $respuesta;

    public function Curso_Rezago()
    {
        return $this->belongsTo(Curso_Rezago::class);
    }

}
