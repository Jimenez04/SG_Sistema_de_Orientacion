<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_Sexo',
        'nombre',
    ];

    protected $id_Sexo;
    protected $nombre;
    
    public function Persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
