<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actitud_Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'influencia_En_El_Curso',
        'descripcion',
        'curso_Rezago_Id',
    ];

    protected $primaryKey = 'curso_Rezago_Id';



    //Relaciones
    public function Curso_Rezago()
    {
        return $this->belongsTo(Curso_Rezago::class,'curso_Rezago_Id', 'id');
    }
}

