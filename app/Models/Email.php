<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'email',
        'persona_cedula',
        'vida_Estudiantil_Id', 
    ];

    public function add($object, $request){
                if($object->Email->where('email', $request['email'])->first() == null){
                    $object instanceof Persona ? $id = $request['cedula'] : $id = $request['id_vida_estudiantil'];
                    if($object->addEmail($id ,$request['email'])){
                                return response()->json([
                                    "status" => true,
                                    "Message" => "El email fue agregado correctamente al usuario",
                                ],200);
                        }else{
                            return response()->json([
                            "status" => false,
                            "error" => "Ocurrio un problema al agregar el email",
                        ],500);
                    }
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "Este email ya esta asociado a su cuenta",
                    ],409);
                }
    }

    public function get_all($object){ 
                $emails = $object->Email;  
                if($emails != null){
                    return response()->json([
                        "success" => true,
                        "message" => "Lista de emails",
                        "data" => $emails
                        ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene ningun email asociado",
                    ],409);
                }
    }

    public function get($object, $id){ 
                $email = $object->Email->find($id);    
                if($email != null){
                    return response()->json([
                        "success" => true,
                        "message" => "Email",
                        "data" => $email
                        ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "El email no existe",
                    ],404);
                }
    }

    public function update_e($object, $request){ 
                $email = $object->Email->find($request['id']);    
                if($email != null){
                    if($object instanceof Persona && $email->email == $object->User->email){
                        return response()->json([
                            "success" => false,
                            "message" => "Imposible actualizar el email principal",
                            ],400);
                    }
                        $object->Email->find($request['id'])->update($request);
                            return response()->json([
                                "success" => true,
                                "message" => "Email actualizado correctamente",
                                ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "El email no existe",
                    ],404);
                }
    }

    public function delete_e($object, $id){ 
                $email = $object->Email->find($id);    
                if($email != null){
                    if($object instanceof Persona && $email->email == $object->User->email){
                        return response()->json([
                            "success" => false,
                            "message" => "Imposible eliminar el email principal",
                            ],400);
                    }
                        $object->Email->find($id)->delete();
                        return response()->json([
                            "success" => true,
                            "message" => "Email eliminado correctamente",
                            ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "El email no existe",
                    ],404);
                }
    }

    public function Persona()
    {
        return $this->belongsTo(Persona::class, 'persona_cedula', 'cedula');
    }
}
