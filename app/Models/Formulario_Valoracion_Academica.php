<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario_Valoracion_Academica extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso__Rezago_Id',  
        'pregunta_Id',
        'respuesta',
        'id'
    ];

    public function addfromReques($object, $request){
            if($object == null){
                return ['status' => false, 'message' => 'Error interno'];
            } 
            $this->limpiar($object);
        foreach ($request['cuestionario'] as $pregunta) {
            $form = new Formulario_Valoracion_Academica($pregunta);
            $object->Curso_Rezago->Formulario_Valoracion_Academica()->save($form); 
        }
    return ["status"=>true];
}

        public function limpiar($object){
            if($object->Curso_Rezago->Formulario_Valoracion_Academica != null){
                $object->Curso_Rezago->Formulario_Valoracion_Academica()->delete();
            }
        }

    public function Curso_Rezago()
    {
        return $this->belongsTo(Curso_Rezago::class, 'curso__Rezago_Id', 'id');
    }
    public function Preguntas_Valoracion()
    {
        return $this->belongsTo(Preguntas_Valoracion::class, 'pregunta_Id', 'id');
    }

}
