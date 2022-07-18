<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'nombre',

    ];

    //relaciones
    public function Preguntas_Valoracion()
    {
        return $this->hasMany(Preguntas_Valoracion::class, 'categoria_id', 'id');
    }
}
