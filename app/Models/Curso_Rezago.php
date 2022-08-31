<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso_Rezago extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'solicitud_Numero',
        'curso_Id',
        'nombre_Curso',
        'grupo',  
        'docente',
        'numero_De_Matriculas',
        'numero_De_Culminaciones',  
        'aspectos_Y_Condiciones_Rezago',
        'actitud_Estudiante',
        'resumen_No_Aprobar_El_Curso',
    
    ];

    protected $primaryKey = 'id';



    //Relaciones
    public function CursoUCR()
    {
        return $this->belongsTo(CursoUCR::class, 'curso_Id', 'id');
    }
    public function Plan_De_Accion_Individual()
    {
        return $this->belongsTo(Plan_De_Accion_Individual::class, 'solicitud_Numero',  'numero_Solicitud');
    }
    public function Actitud_Estudiante()
    {
        return $this->hasOne(Actitud_Estudiante::class, 'curso_Rezago_Id', 'id');
    }
    public function Formulario_Valoracion_Academica()
    {
        return $this->hasOne(Formulario_Valoracion_Academica::class, 'curso_Rezago_Id', 'id');
    }
}
