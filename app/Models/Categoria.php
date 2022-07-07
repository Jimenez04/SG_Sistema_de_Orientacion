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


    protected $id;
    protected $nombre;


    public function Preguntas_Valoracion()
    {
        return $this->belongsTo(Preguntas_Valoracion::class);
    }


}
