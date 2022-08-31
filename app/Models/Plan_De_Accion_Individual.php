<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan_De_Accion_Individual extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'numero_Solicitud',
        'semestre',
        'nombre_Carrera',
        'carrera_Id',  
        'que_Espera_Del_Plan',
        'nombre_Oficina',
        'estudiante_Carnet',  
        'Salud_Como_Impedimento',
        'comentarios_Presentes_Reunion',
    ];
    //protected $primaryKey = ['numero_Solicitud', 'id'];


    //Relaciones
    public function Expediente_Plan_De_Accion()
    {
        return $this->hasOne(Expediente_Plan_De_Accion::class, 'solicitud_Numero', 'numero_Solicitud');
    }
    public function Vida_Estudiantil()
    {
        return $this->hasOne(Vida_Estudiantil::class, 'plan_De_Accion_Id', 'id');
    }
    public function Curso_Rezago()
    {
        return $this->hasOne(Curso_Rezago::class, 'solicitud_Numero', 'numero_Solicitud');
    }
    public function Salud_Fisica_Emocional()
    {
        return $this->hasOne(Salud_Fisica_Emocional::class, 'plan_De_Accion_N_Solicitud', 'numero_Solicitud');
    }
    public function Carrera_UCR()
    {
        return $this->belongsTo(Carrera_UCR::class, 'carrera_Id', 'id');
    }
    public function Archivos()
    {
        return $this->hasMany(Archivos::class, 'plan_De_Accion_Id', 'id');
    }
    public function Estudiante()
    {
        return $this->belongsTo(Estudiantes::class, 'estudiante_Carnet', 'carnet');
    }
}
