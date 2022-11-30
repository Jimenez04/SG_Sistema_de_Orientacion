<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Bitacora extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'descripcion',
        'acciones_realizadas',
        'observaciones',
        'fecha',
        'bitacora_Id',
        
    ];

    public function newInput($idBitacora, $descripcion, $acciones_realizadas, $observaciones)
    {
        try {
            $item = new Item_Bitacora([
                "descripcion" => $descripcion,
                "acciones_realizadas" => $acciones_realizadas,
                "observaciones" => $observaciones,
                "fecha" => Carbon::now(),
            ]);
            $bitacora =  Bitacora::find($idBitacora);
            return $bitacora->addItem($item);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

            public function get_all($id){ 
                $object = Bitacora::find($id);
                if($object == null){
                    return response()->json(['status' => false, 'message' => "No existe la solicitud"]);
                }
                $input = $object->item_Bitacora;  
                if($input != null){
                    return response()->json([
                        "status" => true,
                        "message" => "Lista de entradas",
                        "data" => $input
                        ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene ningun email asociado",
                    ],409);
                }
        }

            public function add($id, $request){
                $object = Bitacora::find($id);
                if($object != null){
                    $status = $this->newInput(
                        $object->id,
                        $request['descripcion'],
                        $request['acciones_realizadas'],
                        $request['observaciones']
                    );
                    if($status){
                                return response()->json([
                                    "status" => true,
                                    "Message" => "La entrada fue agregada correctamente.",
                                ],200);
                        }else{
                            return response()->json([
                            "status" => false,
                            "error" => "Ocurrio un problema al agregar la entrada.",
                        ],500);
                    }
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "La bitácora no existe.",
                    ],409);
                }
            }

            public function get($id, $itemid){ 
                $object = Bitacora::find($id);
                if($object == null){
                    return response()->json(['status' => false, 'message' => "No existe la solicitud"]);
                }
                $items = $object->item_Bitacora->find($itemid);    
                if($items != null){
                    return response()->json([
                        "status" => true,
                        "message" => "Entrada bitácora",
                        "data" => ['id'=>$items->id, 'descripcion' =>  $items->descripcion, 'acciones_realizadas' => $items->acciones_realizadas, 'observaciones' => $items->observaciones, 'fecha' => $items->fecha]
                        ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "La entrada no existe",
                    ],404);
                }
            }

            public function update_e($id, $itemid, $request){ 
                $object = Bitacora::find($id);
                $item = $object->item_Bitacora->find($itemid);    
                if($item != null){
                        $item->update($request);
                        $item->save();
                            return response()->json([
                                "success" => true,
                                "message" => "Entrada actualizada correctamente",
                                ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "La entrada no existe.",
                    ],404);
                }
            }

    public function Bitacora()
    {
        return $this->belongsTo(Bitacora::class, 'bitacora_Id' , 'id');
    }
}
