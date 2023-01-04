<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre_Especialista',
        'descripcion_Recomendacion',
        'revision_Solicitud_id ',
    ];

    public function add($object, $request){
        $recomendacion = new Recomendaciones($request);
            if($object->Recomendaciones()->save($recomendacion)){ 
                            return [
                                "status" => true,
                                "message" => "La recomendación fue agregada correctamente",
                            ];
                    }else{
                        return [
                        "status" => false,
                        "message" => "Ocurrio un problema al agregar la recomendación",
                                ];
                    }
        }

        public function get_all($object){ 
                $recomendaciones = $object->Recomendaciones->sortByDesc('updated_at');;  
                if($recomendaciones != null){
                    return response()->json([
                        "success" => true,
                        "message" => "Lista de recomendaciones",
                        "data" => $recomendaciones
                        ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "Esta solicitud no tiene ninguna recomendación asociada",
                    ],404);
                }
        }

        public function get($object, $id){ 
                $recomendacion = $object->Recomendaciones->find($id);    
                if($recomendacion != null){
                    return response()->json([
                        "success" => true,
                        "message" => "Recomendación",
                        "data" => $recomendacion
                        ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "La recomendación buscada no se encuentra en esta solicitud.",
                    ],404);
                }
        }

        public function delete_e($object, $id){ 
            if($object->Recomendaciones != null){
                $recomendacion = $object->Recomendaciones->find($id); 
                    if($recomendacion != null){
                            Recomendaciones::find($id)->delete();
                            return response()->json([
                                "success" => true,
                                "message" => "Recomendación eliminada correctamente.",
                                ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "Esta recomendación no se encuentra en esta solicitud.",
                        ],404);
                    }
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "Esta solicitud no tiene recomendaciones asociadas.",
                ],404);
            }
        }

        public function update_e($object, $request, $id){ 
            $recomendaciones = $object->Recomendaciones->find($id);    
            if($recomendaciones != null){
                    $recomendaciones->update($request);
                        return response()->json([
                            "status" => true,
                            "message" => "Recomendación actualizada correctamente",
                            ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "La recomendación no existe.",
                ],404);
            }
        }


    public function Revision_Solicitud()
    {
        return $this->belongsTo(Revision_Solicitud::class, 'revision_Solicitud_id', 'id');
    }

    
}
