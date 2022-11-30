<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'numero',
        'persona_cedula',
        'vida_Estudiantil_Id', 
    ];

public function add($object, $request){
            if($object->Contacto->where('numero', $request['numero'])->first() == null){ 
                $object instanceof Persona ? $id = $request['cedula'] : $id = $request['id_vida_estudiantil'];
                if($object->addContact($id, $request['numero'])){ 
                            return response()->json([
                                "status" => true,
                                "Message" => "El número fue agregado correctamente",
                            ],200);
                    }else{
                        return response()->json([
                        "status" => false,
                        "error" => "Ocurrio un problema al agregar el número",
                    ],500);
                }
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "Este número ya esta asociado",
                ],409);
            }
}

public function get_all($object){ 
        $contact = $object->Contacto;  
        if($contact != null){
            return response()->json([
                "success" => true,
                "message" => "Lista de teléfonos",
                "data" => $contact
                ],200);
        }else{
            return response()->json([
                "status" => false,
                "error" => "No tiene ningún teléfono asociado",
            ],409);
        }
}

public function get($object, $id){ 
        $contact = $object->Contacto->find($id);    
        if($contact != null){
            return response()->json([
                "success" => true,
                "message" => "Teléfono",
                "data" => $contact
                ],200);
        }else{
            return response()->json([
                "status" => false,
                "error" => "El teléfono no existe",
            ],404);
        }
}

public function update_e($object, $request){ 
    $contact = $object->Contacto->find($request['id']);    
    if($contact != null){
        $object->Contacto->find($request['id'])->update($request);
        return response()->json([
            "success" => true,
            "message" => "Teléfono actualizado correctamente",
        ],200);
    }else{
        return response()->json([
            "status" => false,
            "error" => "El teléfono no existe",
        ],404);
    }
}

public function delete_e($object, $id){ 
        $contact = $object->Contacto->find($id); 
        if($contact != null){
                $object->Contacto->find($id)->delete();
                return response()->json([
                    "success" => true,
                    "message" => "Teléfono eliminado correctamente",
                    ],200);
        }else{
            return response()->json([
                "status" => false,
                "error" => "El teléfono no existe",
            ],404);
        }
}
    public function Persona()
    {
        return $this->belongsTo(Persona::class, 'persona_cedula', 'cedula');
    }

}
