<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'revision_Solicitud_id',
    ];


    public function add($object, $request){
            $observacion = new Observacion($request);
        if($object->Observacion()->save($observacion)){ 
                        return [
                            "status" => true,
                            "message" => "La observación fue agregada correctamente",
                        ];
                }else{
                    return [
                    "status" => false,
                    "message" => "Ocurrio un problema al agregar la observación",
                            ];
                }
    }

    public function get_all($object){ 
            $observaciones = $object->Observacion->sortByDesc('updated_at');;  
            if($observaciones != null){
                return response()->json([
                    "success" => true,
                    "message" => "Lista de observaciones",
                    "data" => $observaciones
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "Esta solicitud no tiene ninguna observacion asociada",
                ],404);
            }
    }

    public function get($object, $id){ 
            $observacion = $object->Observacion->find($id);    
            if($observacion != null){
                return response()->json([
                    "success" => true,
                    "message" => "Observación",
                    "data" => $observacion
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "La observación buscada no se encuentra en esta solicitud.",
                ],404);
            }
    }

    public function delete_e($object, $id){ 
        if($object->Observacion != null){
            $observacion = $object->Observacion->find($id); 
                if($observacion != null){
                        Observacion::find($id)->delete();
                        return response()->json([
                            "success" => true,
                            "message" => "Observación eliminada correctamente.",
                            ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "Esta observación no se encuentra en esta solicitud.",
                    ],404);
                }
        }else{
            return response()->json([
                "status" => false,
                "error" => "Esta solicitud no tiene observaciones asociadas.",
            ],404);
        }
    }

    public function update_e($object, $request, $id){ 
        $observacion = $object->Observacion->find($id);    
        if($observacion != null){
                $observacion->update($request);
                    return response()->json([
                        "status" => true,
                        "message" => "Observación actualizada correctamente",
                        ],200);
        }else{
            return response()->json([
                "status" => false,
                "error" => "La observación no existe.",
            ],404);
        }
}


    public function Revision_Solicitud()
    {
        return $this->belongsTo(Revision_Solicitud::class, 'revision_Solicitud_id', 'id');
    }
}
