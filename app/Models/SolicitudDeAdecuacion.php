<?php

namespace App\Models;

use App\Events\request_Adequacy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class SolicitudDeAdecuacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'razon_Solicitud',
        'carrera_Empadronada',
        'nombre_segunda_carrera',
        'carrera_empadronado_anterior',
        'ano_ingreso_carrera',
        'nivel_carrera',
        'realizo_Traslado_Carrera',
        'estudiante_carnet',
        'numero_solicitud'
    ];

    /* protected $primarykey = ['id','numero_solicitud']; */

    public function getAll(){
        try{
              $user = Auth::User();
              $student = $user->role->role =='Estudiante' ? true : false;

              $solicitudes = $student ? $user->Persona->Estudiante->SolicitudDeAdecuacion->sortByDesc('created_at') : SolicitudDeAdecuacion::with(['Revision_Solicitud'])->get()->sortByDesc('created_at');
                if($solicitudes == null){
                    return response()->json(['status' => false, 'message' => 'No posee solicitudes de adecuación'], 400);

                  }
                  if($student){
                      $solicitudes = $solicitudes ->map(function ($item){
                          return collect([
                              'id' => $item->id,
                              'numero_solicitud' => $item->numero_solicitud,
                              'carrera_Empadronada' => $item->carrera_Empadronada,
                              'ano_ingreso_carrera' => $item->ano_ingreso_carrera,
                              'nivel_carrera' => $item->nivel_carrera,
                              'realizo_Traslado_Carrera' => $item->realizo_Traslado_Carrera,
                              'estado' => $item->Revision_Solicitud->estado,
                               'fecha' => Carbon::parse($item->Revision_Solicitud->fecha)->format('d-m-Y'),
                          ]);
                      });
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
          $solicitud = $student ? ($user->Persona->Estudiante->SolicitudDeAdecuacion)->find($id) : SolicitudDeAdecuacion::with(['Revision_Solicitud','saludActual','Institucion_Procedencia','Grupo_Familiar','Grupo_Familiar.Pariente', 'Archivos'])->find($id); //archivos
            if($solicitud == null){
                return response()->json(['status' => false, 'message' => 'La solicitud de adecuación no existe'], 400);
            }
                if($student){
                $solicitudparcial = $solicitud;
                $solicitud = json_decode($solicitud, true);
                $solicitud += ['estado' => $solicitudparcial->Revision_Solicitud->estado];
                $solicitud += ['salud_actuals' => $solicitudparcial->saludActual];
                $solicitud += ['necesidad__y__apoyos' => $solicitudparcial->Necesidad_Y_Apoyo];
                $solicitud += ['institucion__procedencias' => $solicitudparcial->Institucion_Procedencia];
                $solicitud += ['archivos' => $solicitudparcial->Archivos];
                $solicitud += ['grupo__familiars' => $solicitudparcial->Grupo_Familiar,['pariente' => $solicitudparcial->Grupo_Familiar->Pariente]];
                //$solicitud += ['archivos' => $solicitudparcial->Revision_Solicitud];
                }
                else{
                   $id_bitacora = $solicitud->Revision_Solicitud->Bitacora->id;
                  $necesidad = $solicitud->Necesidad_Y_Apoyo;
                  $solicitud = json_decode($solicitud, true);
                  $solicitud += ['id_bitacora' => $id_bitacora];
                  $solicitud += ['necesidad__y__apoyos' => $necesidad];
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
          if($estudiante == null){
            return response()->json(['status' => false, 'message' => 'El estudiante no existe'], 400);
          }
            if($estudiante->SolicitudDeAdecuacion == null){
                return response()->json(['status' => false, 'message' => 'No posee solicitudes de adecuación'], 400);
            }
            $solicitud = $estudiante->SolicitudDeAdecuacion->map(function ($item){
             return  collect([

                      'id' => $item->id ,
                      'estudiante_carnet' => $item->estudiante_carnet,
                      'numero_solicitud' => $item->numero_solicitud, 
                
                  'revision__solicitud' => $item->Revision_Solicitud,
              ]);
          });
          return response()->json(['status' => true , 'message' => 'Consulta realizada con éxito', 'data' => $solicitud],200);  
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
            }
          } 


      public function add1($cedula, $solicitudAdecuacion, $institucionProcedencia, $necesidadesY_Apoyo, $familiares, $archivos, $salud){
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
                      }else if(!$student){
                        $persona = new Persona();
                          if($cedula != null){
                            $state = $persona->validate_cedula_DB($cedula, true);
                              if($state['status']){
                                  $student = (Persona::find($cedula))->Estudiante;
                                }else{
                                  return  response()->json(['status' => false , 'message' => 'Error', 'La cédula no esta registrada' => $state],400); 
                              }
                          }else{
                            return  response()->json(['status' => false , 'message' => 'Error', 'Ingrese una cédula' => $state],400); 
                          }
                      }
                if($student !=null && $student instanceof Estudiante){
                  $solicitudAdecuacion['solicitud'] += ['numero_solicitud' => 'A' . Carbon::now()->year . 'M' .Carbon::now()->format('m') . 'E' . $student->persona_cedula . 'S' . $this->semestre()];
                  $state = $this->create($student, $solicitudAdecuacion, $institucionProcedencia, $necesidadesY_Apoyo, $familiares, $archivos, $salud);
                  if($state['status']){
                    return response()->json([
                      "status" => true,
                      "error" => 'Solicitud creada correctamente',
                      ],200);
                  }
                } 
                //$this->eliminarsolicitud($solicitudAdecuacion['solicitud']['numero_solicitud']);
                return response()->json(['status' => false , 'message' => 'Error', 'data' => $state],400);  
              }else{
                return response()->json([
                  "status" => false,
                  "error" => 'Restricción de fechas',
                  "message" => 'Las fechas para realizar solicitudes estan cerradas',
                  ],400);
              }
      }catch(\Throwable $th) {
        $this->eliminarsolicitud($solicitudAdecuacion['solicitud']['numero_solicitud']);
        return response()->json([
            "status" => false,
            "error" => $th->getMessage(),
            ],500);
        }
    }

    public function create($student, $solicitudAdecuacion, $institucionProcedencia, $necesidadesY_Apoyo, $familiares, $archivos, $salud ){
      $state = $student->addSolicitudAdecuacion($solicitudAdecuacion);
      $solicitudadecuacionparcial = (SolicitudDeAdecuacion::where('numero_solicitud', $solicitudAdecuacion['solicitud']['numero_solicitud'])->first());
      if($state['status']){
            if($necesidadesY_Apoyo != null){
              $necesidadApoyo = new Necesidad_Y_Apoyo();
              $state = $necesidadApoyo->add_($solicitudadecuacionparcial, $necesidadesY_Apoyo);
            }
            if($state['status']){
                $saludActual = new saludActual();
                $state =  $saludActual->add_($solicitudadecuacionparcial, $salud);
                  if($state['status']){
                      $institucion = new Institucion_Procedencia();
                      $state = $institucion->add_($solicitudadecuacionparcial, $institucionProcedencia);
                                    if($state['status']){
                                      $grupofamiliar = new Grupo_Familiar();
                                      $state = $grupofamiliar->addfromReques($solicitudadecuacionparcial, $familiares);
                                      if($state['status']){
                                        $archivomodels = new Archivos();
                                        $state = $archivomodels->addfromReques($solicitudadecuacionparcial, $archivos);
                                            $revision = new Revision_Solicitud(); 
                                            $revision->create_NewRequest($solicitudadecuacionparcial);
                                              $bitacora = new Bitacora();
                                              $bitacora->new_FromRequest($solicitudadecuacionparcial->Revision_Solicitud, "revision_Solicitud_Id", "Adecuacion");
                                                $this->sendEmail($solicitudadecuacionparcial);
                                              return [
                                                "status" => true,
                                                "error" => "Solicitud creada correctamente"
                                              ];
                                      }
                                    }
                    }
              }
      }
      return $state;
    }

    public function sendEmail($solicitudadecuacionparcial){
      $arvhico = [];
        foreach($solicitudadecuacionparcial->Archivos as $archivo){
          array_push($arvhico, [ 'pdf' => base64_decode(Storage::disk('public')->get($archivo->url)), 'nombre' => $archivo->nombre .".pdf" ]);
        }
        $PDFrequest = $this->makePDF($solicitudadecuacionparcial);
        array_push($arvhico, [ 'pdf' => $PDFrequest->output(), 'nombre' => $solicitudadecuacionparcial->numero_solicitud . ".pdf" ]);
      request_Adequacy::dispatch($solicitudadecuacionparcial, $arvhico);
    }

    public function makePDF($solicitud){
      $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('adequacy', compact("solicitud"))->setPaper('letter');
      return $pdf;
    }

    public function eliminarsolicitud($numsolicitud){
      try{ 
        if(SolicitudDeAdecuacion::where('numero_solicitud', $numsolicitud)->exists()){
              SolicitudDeAdecuacion::where('numero_solicitud', $numsolicitud)->delete();
                return response()->json([
                  "status" => true,
                  "error" => "Eliminado correctamente",
                  ],200);
            }
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
            }
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

  //salud
  public function addsalud($salud)
  {
    return $this->saludActual()->save($salud);
  }
  //end

   
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
    public function saludActual()
    {
        return $this->hasOne(saludActual::class, 'adecuacion_Solicitud_Id', 'id');
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
