<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actitud_Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'infliencia_En_El_Curso',
        'descripcion'
    ];

    protected $id;
    protected $influencia_En_El_Curso;
    protected $descripcion;

    public function Curso_Rezago()
    {
        return $this->belongsTo(Curso_Rezago::class);
    }
}
