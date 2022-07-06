<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas_Valoracion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'categoria_id',
        'pregunta',

    ];

    protected $id;
    protected $categoria_id;
    protected $pregunta;

    public function Formulario_Valoracion_Academica()
    {
        return $this->belongsTo(Formulario_Valoracion_Academica::class);
    }

}
