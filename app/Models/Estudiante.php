<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'carnet',
        'persona_cedula',
        'ano_Ingreso',
        'profesor_Consejero',
        'carnet_S'
    ];
    public $incrementing = false;
    
    protected $primaryKey = 'carnet';


    public function add($request)
        {
            try {
                $cedula = (trim(stripslashes(htmlspecialchars($request['cedula']))));
                $persona = new Persona(); 
                if($persona->validate_cedula_DB($cedula)){
                        if($persona->belong_to_student($request['cedula'])){
                            return response()->json([
                                "status" => false,
                                "error" => "La cédula ya esta asociada a un estudiante", //Persona ocupada
                                ],400);
                        }
                        $estudiante = Estudiante::create([
                          'carnet' => $request['carnet'],
                          'carnet_S' => $request['carnet'],
                        ]);
                        $estudiante->save();
                        $bitacoraparcial = new Bitacora();
                          $bitacoraparcial->newfromPerson($estudiante);
                          return response()->json([
                              "status" => true,
                              "message" => "Estudiante creado correctamente. OK",
                              ],200);
//
                      }else{
                        return response()->json([
                            "status" => 3,
                            "error" => "Esta persona no existe, 'Estudiante'",
                            ],400);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(), 
                    ],200);
            }
        }

        public function get_all(){ 
          if($this->admin_validatedRol()){
                $list = Estudiante::with(['Persona', 'Persona.User'])->get();  
                if($list != null){
                    return response()->json([
                        "success" => true,
                        "message" => "Lista de estudiantes",
                        "data" => $list
                        ],200);
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No existen estudiantes",
                    ],409);
                }
          }else{
            return response()->json(['mesage'=>"No tiene permisos para acceder a este recurso"], 403);
          }
  }

      public function get($carnet){ 
        $data= null;
        if($this->admin_validatedRol()['status']){
          if($carnet == null){
            $id = Auth::user()->Persona->Administrador->id;
              $data = Administrador::with(['Persona', 'Persona.Email', 'Persona.Contacto', 'Persona.User'])->find($id);
            }else{
                 $data = Estudiante::with(['Persona', 'Persona.Email', 'Persona.Contacto'])->find($carnet);
                    if($data != null){
                      $id_bitacora = $data->Bitacora->id;
                      $data = json_decode($data, true);
                      $data += ['id_bitacora' => $id_bitacora];
                    }
            }
        }else if($this->user_validatedRol()['status']){
          $carnetinterno = Auth::user()->Persona->Estudiante->carnet;
          $data = Estudiante::with(['Persona', 'Persona.Email', 'Persona.Contacto'])->find($carnetinterno);
        }

        if($data != null){
          return response()->json([
              "success" => true,
              "message" => "Estudiante",
              "data" => $data
              ],200);
      }else{
          return response()->json([
              "status" => false,
              "error" => "El estudiante buscado no se encuentra.",
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
      if($object != null){ 
                      $object->update($request);
                          return response()->json([
                              "success" => true,
                              "message" => "Datos del estudiante actualizados correctamente",
                              ],200);
      }else{
          return response()->json([
              "status" => false,
              "error" => "No existe el estudiante",
          ],404);
      }
  }


  
    //Beca
    public function addbeca($cedula = null, $request)
    {
      $beca = new Beca();
      $error = '';
      if($this->admin_validatedRol() || $this->user_validatedRol()){
        
        $data = $cedula != null ? $this->validate_cedula_DB($request['cedula'], true) : ['status'=>'no'];
            if(!$data['status']){
              return response()->json($data,400);
            }
        $student = $cedula != null ? Persona::find($cedula)->Estudiante : Auth::user()->Persona->Estudiante;
            if ($student->Beca === null)
            {
              $status = $beca->add($request);
              $student->Beca()->save($status);
              return response()->json(['status' => true , 'message' => 'Beca creada correctamente'],200);
            }else{
              return response()->json(['status' => false , 'message' => 'Ya dispone de una beca'],400);
            }
      }
      return response()->json(['mesage'=>"No tiene permisos para acceder a este recurso", 'error' => $error], 403);
    }

    public function user_validated($request){
      if($request['cedula'] == Auth::user()->Persona->cedula){ 
          return  ['status'=>true];
      }else{
          return [
              "status" => false,
              "error" => "No tiene permisos para editar esta persona",
                  ];
      }
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
  public function user_validatedRol(){
      if("Estudiante" == Auth::user()->role->role){
          return  ['status'=>true];
      }else{
          return [
              "status" => false,
                  ];
      }
  }


    public function validate_cedula_DB($cedula, $json = false){
      $data = Persona::where('cedula', $cedula)->exists();
          if(!$json){
              return $data;
          }else{
              if($data){
                  return [
                      "status" => $data,
                  ];
              }
                  return [
                      "status" => $data,
                      "error" => "La persona no existe en la base de datos",
                  ];
          }
  }

    public function getBeca()
    {
      return $this->Beca()->get()->first()->id;
    }
    //endbeca
    
    //carreras
    public function addcarrera($carrera)
    {
      return $this->Carrera()->save($carrera);
    }
    public function getcarrera()
    {
      return $this->Carrera()->get()->first();
    }
    public function countCarrera()
    {
        return $this->Carrera()->count();
    }

    //endbendcarreras

    //SolicitudDeAdecuacion
    public function addSolicitudAdecuacion($request)
    {
      $solicitud = new SolicitudDeAdecuacion($request['solicitud']);
        if(SolicitudDeAdecuacion::where('numero_solicitud', $request['solicitud']['numero_solicitud'])->exists()){
          return ['status' => false, 'message' => 'La solicitud ya existe en el sistema'];
        }else if($this->SolicitudDeAdecuacion()->save($solicitud)){
          return ['status' => true, 'message' => 'Creada correctamente'];
        }
          return ['status' => false, 'message' => 'Error interno'];
    }
    //EndSolicitudDeAdecuacion

     //SolicitudPAI
     public function addSolicitudPAI($request)
     {
       $solicitud = new Plan_De_Accion_Individual($request['solicitud']);
       if(Plan_De_Accion_Individual::where('numero_Solicitud', $request['solicitud']['numero_Solicitud'])->exists()){
         return ['status' => false, 'message' => 'La solicitud ya existe en el sistema'];
        }else if($this->SolicitudPAI()->save($solicitud)){
          return ['status' => true, 'message' => 'Creada correctamente'];
         }
           return ['status' => false, 'message' => 'Error interno'];
     }
     //EndPAI
        public function agregarProfesorConsejero($profesorconsejero){
          $this->profesor_Consejero = $profesorconsejero->profesor_Consejero;
          $this->save();
        }

        public function primaryKey()
        {
            return DB::table("estudiantes")->where('carnet', $this->carnet)->first()->carnet;
        }

        //  relaciones
        public function Beca()
        { 
          return $this->hasOne(Beca::class, 'estudiante_carnet', 'carnet');	
        }
        
        public function Carrera()
        {
          return $this->hasMany(Carrera::class, 'estudiante_carnet', 'carnet');
    }
    public function Bitacora()
    {
        return $this->hasOne(Bitacora::class, 'estudiante_carnet', 'carnet' );
    }
    public function SolicitudDeAdecuacion()
    {
      return $this->hasMany(SolicitudDeAdecuacion::class, 'estudiante_carnet', 'carnet');
    }
    public function SolicitudPAI()
    {
      return $this->hasMany(Plan_De_Accion_Individual::class, 'estudiante_Carnet', 'carnet');
    }
    public function Persona()
    {
        return $this->belongsTo(Persona::class, 'persona_cedula', 'cedula');	
    }
  }
