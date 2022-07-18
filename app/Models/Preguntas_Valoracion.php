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


    //relaciones
    public function Formulario_Valoracion_Academica()
    {
        return $this->hasMany(Formulario_Valoracion_Academica::class, 'pregunta_Id', 'id');
    }
    public function Categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

}
