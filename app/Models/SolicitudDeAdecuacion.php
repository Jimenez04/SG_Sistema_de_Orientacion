<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SolicitudDeAdecuacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'razon_Solicitud',
        'carrera_Empadronada',
        'carreras_simultaneas',
        'realizo_Traslado_Carrera',
        'descripcion',
        'url_Archivo_Situacion_Academica_Actual',
        'url_Archivo_Dictamen_Medico',
        'url_Archivo_Diagnostico',
        'estudiante_carnet',
        'numero_solicitud'
    ];

    /* protected $primarykey = ['id','numero_solicitud']; */

    public function getAll(){
        try{
              $user = Auth::User();
              $student = $user->role->role =='Estudiante' ? true : false;

              $solicitudes = $student ? $user->Persona->Estudiante->SolicitudDeAdecuacion : SolicitudDeAdecuacion::all();
                if($solicitudes == null){
                    return response()->json(['status' => false, 'message' => 'No posee solicitudes de adecuación'], 400);
                }
              return response()->json(['status' => true , 'message' => 'Consulta realizada con éxito', 'data' => $solicitudes],200);  
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function get($id){
        try{
          
            $isnumeric = json_decode($this->verificarID($id)->getContent());
            if(!$isnumeric->status){
                return response()->json($isnumeric,400);
            }
          $user = Auth::User();
          $student = $user->role->role =='Estudiante' ? true : false;
          $solicitud = $student ? ($user->Persona->Estudiante->SolicitudDeAdecuacion)->find($id) : SolicitudDeAdecuacion::find($id);
            if($solicitud == null){
                return response()->json(['status' => false, 'message' => 'La solicitud de adecuación no existe'], 400);
            }
          return response()->json(['status' => true , 'message' => 'Consulta realizada con éxito', 'data' => $solicitud],200);  
      }catch(\Throwable $th) {
        return response()->json([
            "status" => false,
            "error" => $th->getMessage(),
            ],500);
        }
    }

     public function getForCarnet($carnet){
      try{
          if($carnet != null){
            $carnet = (trim(stripslashes(htmlspecialchars($carnet))));
          }
          $estudiante = Estudiante::find($carnet);
            if($estudiante->SolicitudDeAdecuacion == null){
                return response()->json(['status' => false, 'message' => 'No posee solicitudes de adecuación'], 400);
            }
          return response()->json(['status' => true , 'message' => 'Consulta realizada con éxito', 'data' => $estudiante->SolicitudDeAdecuacion],200);  
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
            }
          } 


      public function add1($cedula, $solicitudAdecuacion, $institucionProcedencia, $necesidadesY_Apoyo, $enfermedades, $trabajos, $familiares, $beca, $archivos){
        try{
          $state = "";
          if(fechasSolicitudes::find(1)->desde <= Carbon::now() && Carbon::now() <= fechasSolicitudes::find(1)->hasta){
                if($cedula != null){
                  $cedula = (trim(stripslashes(htmlspecialchars($cedula))));
                }
                $user = Auth::User();
                $student = $user->role->role =='Estudiante' ? true : false;
                      if($student){
                        $student = (Persona::find($user->Persona->cedula))->Estudiante;
                      }else if(!$student && $cedula != null){
                        $persona = new Persona();
                        $state = $persona->validate_cedula_DB($cedula, true);
                          if($state['status']){
                              $student = (Persona::find($cedula))->Estudiante;
                            }
                      }
                if($student !=null && $student instanceof Estudiante){
                  $solicitudAdecuacion['solicitud'] += ['numero_solicitud' => 'A' . Carbon::now()->year . 'M' .Carbon::now()->format('m') . 'E' . $student->persona_cedula . 'S' . $this->semestre()];
                  $state = $this->create($student, $solicitudAdecuacion, $institucionProcedencia, $necesidadesY_Apoyo, $enfermedades, $trabajos, $familiares, $beca, $archivos);
                  if($state['status']){
                    return response()->json([
                      "status" => true,
                      "error" => 'Solicitud creada correctamente',
                      ],200);
                  }
                } 
                  return response()->json(['status' => false , 'message' => 'Error', 'data' => $state],400);  
              }else{
                return response()->json([
                  "status" => false,
                  "error" => 'Restricción de fechas',
                  "message" => 'Las fechas para realizar solicitudes estan cerradas',
                  ],400);
              }
      }catch(\Throwable $th) {
        return response()->json([
            "status" => false,
            "error" => $th->getMessage(),
            ],500);
        }
    }

    public function create($student, $solicitudAdecuacion, $institucionProcedencia, $necesidadesY_Apoyo, $enfermedades, $trabajo, $familiares, $beca, $archivos ){
      $state = $student->addSolicitudAdecuacion($solicitudAdecuacion);
      if(
        //true
        $state['status']
        ){
          $necesidadApoyo = new Necesidad_Y_Apoyo();
          $state = $necesidadApoyo->add_($solicitudAdecuacion['solicitud']['numero_solicitud'], $necesidadesY_Apoyo);
            if(
              //true
              $state['status']
              ){
                $enfermedad = new Enfermedad();
                $state =  json_decode($enfermedad->addfromReques($student, $enfermedades)->getContent());
                  if(
                    //true
                    $state->status || $state->error == "Esta enfermedad ya esta asociada"
                    ){
                      $institucion = new Institucion_Procedencia();
                      $state = $institucion->add_($solicitudAdecuacion['solicitud']['numero_solicitud'], $institucionProcedencia);
                        if($state['status']){
                          $trabajomodel = new Trabajo();
                          $state = json_decode($trabajomodel->addfromReques($student, $trabajo)->getContent());
                            if($state->status || $state->error == "Ya tiene un trabajo asociado"){
                              $becamodel = new Beca();
                              $state = $becamodel->addfromReques($student, $beca);
                                if($state['status']){
                                  $grupofamiliar = new Grupo_Familiar();
                                  $state = $grupofamiliar->addfromReques($solicitudAdecuacion['solicitud']['numero_solicitud'], $familiares);
                                  if($state['status']){
                                    $archivomodels = new Archivos();
                                    $state = $archivomodels->addfromReques($solicitudAdecuacion['solicitud']['numero_solicitud'], $archivos);
                                    dd("Hola2");
                                  }
                                }
                            }
                        }
                    }
              }
          
          dd("Hola");
      }
      return $state;
    }

    public function semestre(){
        if(Carbon::now()->month >= 1 && Carbon::now()->month < 3){
            return "III";
        }else if(Carbon::now()->month >= 3 && Carbon::now()->month <  8){
            return "I";
        }else if(Carbon::now()->month >= 8 && Carbon::now()->month <=  12){
            return "II";
        }
           }



    
  //Archivos
  public function addArhivos($arhivo)
  {
    return $this->Archivos()->save($arhivo);
  }
  public function getArhivos()
  {
    return $this->Archivos()->get()->first();
  }
  public function countArchivos()
  {
      return $this->Archivos()->count();
  }
  //EndArchivos

  //Revision_Solicitud
  public function addRevisionSolicitud($revision)
  {
    return $this->Revision_Solicitud()->save($revision);
  }
  public function getRevisionSolicitudId()
  {
    return $this->Revision_Solicitud()->get()->first()->id;
  }
  public function countRevisionSolicitud()
  {
      return $this->Revision_Solicitud()->count();
  }
  //EndRevision_Solicitud

  //Necesidad y Apoyo
  public function addRNecesidadY_Apoyo($necesidad)
  {
    return $this->Necesidad_Y_Apoyo()->save($necesidad);
  }
  public function addInstitucion($institucion)
  {
    return $this->Institucion_Procedencia()->save($institucion);
  }
  //End necesidad y Apoyo

   
  //relaciones
    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_carnet', 'carnet');
    }
    public function Necesidad_Y_Apoyo()
    {
        return $this->hasOne(Necesidad_Y_Apoyo::class, 'solicitud_Numero', 'numero_solicitud');
    }
    public function Institucion_Procedencia()
    {
        return $this->hasOne(Institucion_Procedencia::class, 'solicitud_Numero', 'numero_solicitud');
    }
    public function Revision_Solicitud()
    {
        return $this->hasOne(Revision_Solicitud::class, 'solicitud_Numero', 'numero_solicitud');
    }
    public function Archivos(){
        return $this->hasMany(Archivos::class, 'adecuacion_Solicitud_Id', 'id');
    }
    public function Grupo_Familiar(){
        return $this->hasOne(Grupo_Familiar::class, 'adecuacion_Solicitud_Id', 'id');
    }


    public function verificarID($id){
      if(!is_numeric($id)){
          return response()->json([
              "status" => false,
              "error" => "El id debe ser un número",
          ],400);
      }else{return response()->json([
          "status" => true,
      ],200);}
  }

}
