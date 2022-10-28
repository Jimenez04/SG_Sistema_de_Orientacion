<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;

protected $fillable = [
    'id',
    'trabajo_Actual',
    'actividad_Que_Desempena',
    'lugar_De_Trabajo',
    'jornada_Trabajo',
    'horario_Laboral',
];

public function addfromReques($object, $request){
    $trabajo = $request['trabajo'];
    $estado = "";
        if(array_key_exists('id', $trabajo)){
            $estado = $this->add($object->Persona, $trabajo, $trabajo['id']);
        }else{
            $estado =  $this->add($object->Persona, $trabajo);
        }
    return $estado;
}

    public function add($object, $request, $id = null){
        if($id != null){$this->update_e($object, $request);} 
        if($object->Trabajo == null){
            $job = $this->addJob($request);
            if($job->addperson($object->cedula)){
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
                "error" => "Ya tiene un trabajo asociado",
            ],404);
        }
    }

    public function get_all($object){ 
            $trabajo = $object->Trabajo;  
            if($trabajo != null){
                return response()->json([
                    "success" => true,
                    "message" => "Lista de trabajos",
                    "data" => $trabajo
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "No tiene ningun trabajo asociado",
                ],404);
            }
    }

    public function get($object, $id){ 
            $trabajo = $object->Trabajo->id == $id ? $object->Trabajo : null;
            if($trabajo != null){
                return response()->json([
                    "success" => true,
                    "message" => "Trabajo",
                    "data" => $trabajo
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "El trabajo buscado no se encuentra en su cuenta",
                ],404);
            }
    }

    public function update_e($object, $request){ 
        if($object->Trabajo != null){
                $trabajo = $object->Trabajo->id == $request['id'] ? $object->Trabajo : null;
                if($trabajo != null){
                        $object->Trabajo->update($request);
                            return response()->json([
                                "success" => true,
                                "message" => "Datos del trabajo actualizados correctamente",
                                ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "El trabajo que intenta actualizar no existe",
                    ],404);
                }
        }else{
            return response()->json([
                "status" => false,
                "error" => "No tiene un trabajo asociado",
            ],404);
        }
    }

    public function delete_e($object, $id){ 
        if($object->Trabajo != null){
            $trabajo = $object->Trabajo->id == $id ? $object->Trabajo : null;
                if($trabajo != null){
                        $object->trabajo_id = null;
                        $object->save();
                        Trabajo::find($trabajo->id)->delete();
                        return response()->json([
                            "success" => true,
                            "message" => "Trabajo eliminado correctamente",
                            ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No existe este trabajo en su perfil",
                    ],404);
                }
        }else{
            return response()->json([
                "status" => false,
                "error" => "No tiene un trabajo asociado",
            ],404);
        }
    }

    public function addJob($request){
        $trabajo = Trabajo::Create($request);
        $trabajo->save();
        return Trabajo::find($trabajo->id);
    }

    public function Persona()
    {
        return $this->hasOne(Persona::class, 'trabajo_id', 'id');
    }

    public function addperson($cedula){
        $persona = Persona::find($cedula);
        return $this->Persona()->save($persona);
    }
}
