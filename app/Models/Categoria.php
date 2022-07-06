<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'nombre_Categoria',

    ];


    protected $id;
    protected $nombre_Categoria;


    public function Preguntas_Valoracion()
    {
        return $this->belongsTo(Preguntas_Valoracion::class);
    }


}
