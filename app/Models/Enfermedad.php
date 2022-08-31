<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'persona_cedula',
        'tipo_Enfermedad',
        'descripcion',
        'tratamiento',
        'rutina_Tratamiento',
    ];

    public function add($object, $request){
        if($object->Enfermedad->where('tipo_Enfermedad', $request['tipo_Enfermedad'])->first() == null){
            if($object->addSickness($request)){
                        return response()->json([
                            "status" => true,
                            "Message" => "Agregado correctamente",
                        ],200);
                }else{
                    return response()->json([
                    "status" => false,
                    "error" => "Ocurrio un problema al agregar",
                ],500);
            }
        }else{
            return response()->json([
                "status" => false,
                "error" => "Esta enfermedad ya esta asociada",
            ],409);
        }
    }

    public function get_all($object){ 
            $enfermedades = $object->Enfermedad;  
            if($enfermedades != null){
                return response()->json([
                    "success" => true,
                    "message" => "Lista de enfermedades",
                    "data" => $enfermedades
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "No tiene ninguna enfermedad asociada",
                ],409);
            }
    }

    public function get($object, $id){ 
            $enfermedad = $object->Enfermedad->find($id);    
            if($enfermedad != null){
                return response()->json([
                    "success" => true,
                    "message" => "Enfermedad",
                    "data" => $enfermedad
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "La enfermedad no se encuentra en su cuenta",
                ],404);
            }
    }

    public function update_e($object, $request){ 
        if($object->Enfermedad->where('tipo_Enfermedad', $request['tipo_Enfermedad'])->first() == null){
                $enfermedad = $object->Enfermedad->find($request['id']);    
                if($enfermedad != null){
                        $object->Enfermedad->find($request['id'])->update($request);
                            return response()->json([
                                "success" => true,
                                "message" => "Datos de enfermedad actualizados correctamente",
                                ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "La enfermedad que intenta actualizar no existe",
                    ],404);
                }
        }else{
            return response()->json([
                "status" => false,
                "error" => "Esta enfermedad ya esta asociada",
            ],409);
        }
    }

    public function delete_e($object, $id){ 
            $enfermedad = $object->Enfermedad->find($id);    
            if($enfermedad != null){
                    $object->Enfermedad->find($id)->delete();
                    return response()->json([
                        "success" => true,
                        "message" => "Eliminado correctamente",
                        ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "No existe la enfermedad en su perfil",
                ],404);
            }
    }

    public function Persona()
    {
        return $this->belongsTo(Persona::class,  'persona_cedula', 'cedula');	
    }
}
