<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoUCR extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'carrera_id',
        'nombre',
        'creditos', 
    ];
    //protected $primaryKey = ['id', 'carrera_id'];

    public function carrera_UCR()
    {
        return $this->belongsTo(carrera_UCR::class, 'carrera_id', 'id');
    }

    public function Curso_Rezago()
     {
         return $this->hasMany(Curso_Rezago::class, 'curso_Id', 'id');
     }
}
