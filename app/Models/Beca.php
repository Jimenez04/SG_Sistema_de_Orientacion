<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Beca extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'estudiante_carnet',
        'categoria_Beca',
        'asistencia_Socioeconomica',
        'participacion',
    ];

    //
    public function addfromReques($object, $request){
        $beca = new Beca($request['beca']);
        if($object->Beca == null){
            $object->Beca()->save($beca);
        }else{
            $object->Beca->update($request['beca']);
        }
       return ["status" => true];
    }

    public function add($request){
            $beca = $this->addBeca($request);
            if($beca != null){
                        return $beca;
                }else{ 
                        return false;
            }
    }

    public function get_all($object){ 
            $beca = $object->Beca;  
            if($beca != null){
                return response()->json([
                    "status" => true,
                    "message" => "Lista de becas",
                    "data" => $beca
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "No tiene ninguna beca asociada",
                ],409);
            }
    }

    public function get($carnet = null){ 
        if($this->admin_validatedRol()['status']){
            if($carnet == null || $carnet == " "){
                return response()->json([
                    "status" => false,
                    "error" => "Ingrese un carnet de estudiante",
                ],404);
            }
            $object = Estudiante::find($carnet);
        }else{
            $object = Auth::user()->Persona->Estudiante;
        }
            $beca = $object->Beca;
            if($beca != null){
                return response()->json([
                    "status" => true,
                    "message" => "Beca",
                    "data" => $beca
                    ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "No posee información de beca",
                ],404);
            }
    }

    public function update_e($request){ 
        $object ='';
        if($this->admin_validatedRol()['status']){
          $object = Estudiante::find($request['carnet']);
        }else{
            $object = Auth::user()->Persona->Estudiante;
            $request['carnet'] = $object->carnet;
        }
        if($object->Beca != null){ 
                        $object->Beca->update($request);
                            return response()->json([
                                "status" => true,
                                "message" => "Datos de beca actualizados correctamente",
                                ],200);
        }else{
            return response()->json([
                "status" => false,
                "error" => "No tiene ninguna beca asociada",
            ],404);
        }
    }

    public function delete_e($object, $id){ 
        if($object->Beca != null){
            $beca = $object->Beca->find($id);
                if($beca != null){
                        $beca->delete();
                        return response()->json([
                            "status" => true,
                            "message" => "Beca eliminada correctamente",
                            ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "El 赤tem no existe en su perfil.",
                    ],404);
                }
        }else{
            return response()->json([
                "status" => false,
                "error" => "No tiene ninguna beca asociada",
            ],404);
        }
    }

    public function addBeca($request){
        $beca = Beca::Create($request);
        $beca->save();
        return Beca::find($beca->id);
    }


    //
    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_carnet', 'carnet');
    }

    public function admin_validatedRol(){
        if("Administrador" == Auth::user()->role->role){
            return  ['status'=>true];
        }else{
            return [
                "status" => false,
                    ];
        }
    }

}
