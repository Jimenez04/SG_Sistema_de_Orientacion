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
        'carrera_Id',  
        'que_Espera_Del_Plan',
        'nombre_Oficina',
        'estudiante_Carnet',  
        'Salud_Como_Impedimento',
        'comentarios_Presentes_Reunion',
    
    ];

    protected $id;
    protected $numero_Solicitud;
    protected $semestre;
    protected $carrera_Id;
    protected $que_Espera_Del_Plan;
    protected $nombre_Oficina;
    protected $estudiante_Carnet;
    protected $Salud_Como_Impedimento;
    protected $comentarios_Presentes_Reunion;

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class);
    }

    public function Vida_Estudiantil()
    {
        return $this->hasOne(Vida_Estudiantil::class);
    }
    public function Curso_Rezago()
    {
        return $this->hasOne(Curso_Rezago::class);
    }
    public function Salud_Fisica_Emocional()
    {
        return $this->hasOne(Salud_Fisica_Emocional::class);
    }
    public function Carrera_UCR()
    {
        return $this->hasMany(Carrera_UCR::class);
    }
    public function Archivos()
    {
        return $this->hasOne(Archivos::class);
    }
    public function Estudiantes()
    {
        return $this->hasMany(Estudiantes::class);
    }
}
