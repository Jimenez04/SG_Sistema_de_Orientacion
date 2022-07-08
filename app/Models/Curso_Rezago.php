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
        'grupo',  
        'docente',
        'numero_De_Matriculas',
        'numero_De_Culminaciones',  
        'aspectos_Y_Condiciones_Rezago',
        'actitud_Estudiante',
        'resumen_No_Aprobar_El_Curso',
    
    ];

    protected $id;
    protected $solicitud_Numero;
    protected $curso_Id;
    protected $grupo;
    protected $docente;
    protected $numero_De_Matriculas;
    protected $numero_De_Culminaciones;
    protected $aspectos_Y_Condiciones_Rezago;
    protected $actitud_Estudiante;
    protected $resumen_No_Aprobar_El_Curso;

    public function CursoUCR()
    {
        return $this->belongsTo(CursoUCR::class);
    }

    public function Plan_De_Accion_Individual()
    {
        return $this->hasOne(Plan_De_Accion_Individual::class);
    }
    public function Actitud_Estudiante()
    {
        return $this->hasOne(Actitud_Estudiante::class);
    }
    public function Formulario_Valoracion_Academica()
    {
        return $this->hasOne(Formulario_Valoracion_Academica::class);
    }
 
}
