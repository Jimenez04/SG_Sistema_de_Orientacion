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

    public function add($object, $request){
        $curso = new Curso_Rezago($request);
    if($object->Curso_Rezago()->save($curso)){ 
        $actitud = new Actitud_Estudiante();
        $object->Curso_Rezago->Actitud_Estudiante()->save($actitud);  
                    return [
                        "status" => true,
                    ];
            }else{
                return [
                "status" => false, "message" => "Error al crear el curso"
                        ];
            }
    }

    public function i_update($object, $request){
    if($object->Curso_Rezago->update($request)){ 
                    return [
                        "status" => true,
                    ];
            }else{
                return [
                "status" => false,"message" => "Error al actualizar el curso"
                        ];
            }
    }

    public function add_ActitudEstudiante($object, $request){
    if($object->Curso_Rezago->Actitud_Estudiante->update($request)){ 
                    return [
                        "status" => true,
                    ];
            }else{
                return [
                "status" => false, "message" => "Error al crear la actitud"
                        ];
            }
    }
    
    public function add_Formulario($object, $request){
        $formulario = new Formulario_Valoracion_Academica();
        if($formulario->addfromReques($object,$request)){ 
                    return [
                        "status" => true,
                    ];
            }else{
                return [
                "status" => false, "message" => "Error al crear."
                        ];
            }
    }



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
        return $this->hasMany(Formulario_Valoracion_Academica::class, 'curso__Rezago_Id', 'id');
    }
}
