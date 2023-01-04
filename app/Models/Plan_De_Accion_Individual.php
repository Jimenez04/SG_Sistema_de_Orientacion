<?php

namespace App\Models;

use App\Events\request_PAI;
use App\Events\resume_PAI;
use App\Events\update_statu_PAI;
use App\Mail\resumePAI;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use PDF;

class Plan_De_Accion_Individual extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'numero_Solicitud',
        'semestre',
        'nombre_Carrera',
        'carrera_Id',  
        'que_Espera_Del_Plan',
        'nombreoficina',
        'estudiante_Carnet',  
        'salud_Como_Impedimento',
        'comentarios_Presentes_Reunion',
        'estado',
        'administrador_Id',
        'profesional_VidaEstudiantil'
    ];
    //protected $primaryKey = ['numero_Solicitud', 'id'];

    public function getAll(){
        try{
              $user = Auth::User();
              $student = $user->role->role =='Estudiante' ? true : false;

              $solicitudes = $student ? $user->Persona->Estudiante->SolicitudPAI :  Plan_De_Accion_Individual::with(['Curso_Rezago'])->get();
                
              if($solicitudes == null){
                    return response()->json(['status' => false, 'message' => 'No posee solicitudes de tipo PAI'], 400);
                }
                if($student){
                    $solicitudes = $solicitudes ->map(function ($item){
                        return collect([
                            'id' => $item->id,
                            'numero_Solicitud' => $item->numero_Solicitud,
                            'nombre_Carrera' => $item->nombre_Carrera,
                            'semestre' => $item->semestre,
                            'estado' => $item->estado,
                            'Curso_Rezago' => $item->Curso_Rezago->resumen_No_Aprobar_El_Curso,
                            'nombre_Curso' => $item->Curso_Rezago->nombre_Curso,
                            'numero_De_Matriculas' => $item->Curso_Rezago->numero_De_Matriculas,
                            'grupo' => $item->Curso_Rezago->grupo,
                            'docente' => $item->Curso_Rezago->docente,
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
          $solicitud = $student ? ($user->Persona->Estudiante->SolicitudPAI)->find($id) : Plan_De_Accion_Individual::with(['Curso_Rezago','Salud_Fisica_Emocional', 'Curso_Rezago.Actitud_Estudiante',  'Curso_Rezago.Formulario_Valoracion_Academica'])->find($id);
            if($solicitud == null){
                return response()->json(['status' => false, 'message' => 'La solicitud PAI no existe'], 400);
            }
            if($student){
                $solicitud = $solicitud ->map(function ($item){
                    return collect([
                        'id' => $item->id,
                        'numero_Solicitud' => $item->numero_Solicitud,
                        'nombre_Carrera' => $item->nombre_Carrera,
                        'semestre' => $item->semestre,
                        'estado' => $item->estado,
                        'Curso_Rezago' => $item->Curso_Rezago->resumen_No_Aprobar_El_Curso,
                        'nombre_Curso' => $item->Curso_Rezago->nombre_Curso,
                        'numero_De_Matriculas' => $item->Curso_Rezago->numero_De_Matriculas,
                        'grupo' => $item->Curso_Rezago->grupo,
                        'docente' => $item->Curso_Rezago->docente,
                    ]);
                });
            }else{
                $id_bitacora = $solicitud->Bitacora->id;
                $solicitud = json_decode($solicitud, true);
                $solicitud += ['id_bitacora' => $id_bitacora];
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
              if($estudiante->SolicitudPAI == null){
                  return response()->json(['status' => false, 'message' => 'No posee solicitudes PAI'], 400);
              }

              $solicitud = $estudiante->SolicitudPAI->map(function ($item){
                return collect([
                    'item' => [
                    'id' => $item->id,
                    'numero_Solicitud' =>$item->numero_Solicitud,
                    'semestre' =>$item->semestre,
                    'nombre_Carrera' =>$item->nombre_Carrera,
                    'carrera_Id' =>$item->carrera_Id,  
                    'que_Espera_Del_Plan' =>$item->que_Espera_Del_Plan,
                    'nombre_Oficina' =>$item->nombre_Oficina,
                    'estudiante_Carnet' =>$item->estudiante_Carnet,  
                    'salud_Como_Impedimento' =>$item->salud_Como_Impedimento,
                    'comentarios_Presentes_Reunion' =>$item->comentarios_Presentes_Reunion,
                    'estado' =>$item->estado,
                    'profesional_VidaEstudiantil' =>$item->profesional_VidaEstudiantil
                ],
                    'Curso' => $item->Curso_Rezago,
                    'Formulario' => $item->Curso_Rezago->Formulario_Valoracion_Academica,
                    'Actitud' => $item->Curso_Rezago->Actitud_Estudiante,
                    'Salud' => $item->Salud_Fisica_Emocional,
                    'id_Bitacora' => $item->Bitacora->id,
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
    
    public function eliminarsolicitud($numsolicitud){
        try{
            if(Plan_De_Accion_Individual::where('numero_Solicitud', $numsolicitud)->exists()){
                Plan_De_Accion_Individual::where('numero_Solicitud', $numsolicitud)->delete();
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

        public function newPAI($cedula, $solicitudPAI ){
            try {
                $state = "";
                if(fechasSolicitudes::find(2)->desde <= Carbon::now() && Carbon::now() <= fechasSolicitudes::find(2)->hasta){
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

                            if($student != null && $student instanceof Estudiante){
                                $solicitudPAI['solicitud'] += [ 'numero_Solicitud' => 'PAI_' . 'A' . Carbon::now()->year . 'M' .Carbon::now()->format('m') . 'E' . $student->persona_cedula . 'S' . $this->semestre()];
                                    $state = $this->create($student, $solicitudPAI);
                                        if($state['status']){
                                        return response()->json([
                                            "status" => true,
                                            "message" => 'Solicitud creada correctamente',
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
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function create($student, $solicitudPAI){
            $solicitudPAI['solicitud'] += [ 'estado' =>$this->newStatus(1) ];
            $solicitudPAI['solicitud']['semestre'] = $this->numberToRoman($solicitudPAI['solicitud']['semestre']);

            $state = $student->addSolicitudPAI($solicitudPAI);
                $solicitudparcial = (Plan_De_Accion_Individual::where('numero_solicitud', $solicitudPAI['solicitud']['numero_Solicitud'])->first());
                if($state['status']){
                        $curso = new Curso_Rezago();
                        $state = $curso->add($solicitudparcial, $solicitudPAI['solicitud']);
                        if($state['status']){
                                $admin = Administrador::find(1);
                                $admin->PlanDeAccionIndividual()->save($solicitudparcial);
                                $salud = new Salud_Fisica_Emocional();
                                $solicitudparcial->Salud_Fisica_Emocional()->save($salud);
                                    $bitacora = new Bitacora();
                                    $bitacora->new_FromRequest($solicitudparcial, "pai_Solicitud_Id", "PAI");
                               $this->sendEmail($solicitudparcial, 'new');
                            }
                    }
            return $state;
        }

        private function newStatus($status){
            switch ($status) {
                case '1':
                    return "Enviado para su revisión";
                break;

                case '2':
                    return "En proceso";
                    break;

                case '3':
                    return "Terminado";
                    break;

                case '4':
                    return "Rechazado";
                    break;
                
                default:
                    return "En proceso";
                    break;
            }
        }

        public function sendEmail($solicitud, $tipo){
            $arvhico = [];
            // foreach($solicitudadecuacionparcial->Archivos as $archivo){
            //     array_push($arvhico, [ 'pdf' => base64_decode(Storage::disk('public')->get($archivo->url)), 'nombre' => $archivo->nombre .".pdf" ]);
            // }
            $PDFrequest = $this->makePDF($solicitud, $tipo == 'new' ? 'PAI' : 'PAIAdmin');
            array_push($arvhico, [ 'pdf' => $PDFrequest->output(), 'nombre' => $solicitud->numero_Solicitud . ".pdf" ]);
            if( $tipo == 'new'){
                request_PAI::dispatch($solicitud, $arvhico);
            }else if($tipo == 'update'){
                resume_PAI::dispatch($solicitud, $arvhico);
            }
            
        }
    
        public function makePDF($solicitud, $vista){
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView($vista, compact("solicitud"))->setPaper('letter');
            return $pdf;
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

        function numberToRoman($num)  
        { 
                // Be sure to convert the given parameter into an integer
                $n = intval($num);
                $result = ''; 
                // Declare a lookup array that we will use to traverse the number: 
                $lookup = array(
                    'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
                    'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
                    'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
                ); 

                foreach ($lookup as $roman => $value)  
                {
                    // Look for number of matches
                    $matches = intval($n / $value); 

                    // Concatenate characters
                    $result .= str_repeat($roman, $matches); 

                    // Substract that from the number 
                    $n = $n % $value; 
                } 

                return $result; 
        } 

        public function resumePAI($numsolicitud, $request){
            try {
                $status = '';
                if(!Plan_De_Accion_Individual::where('numero_Solicitud', $numsolicitud)->exists()){
                    return response()->json([
                      "status" => false,
                      "error" => "La solicitud ingresada no existe en el sistema",
                      ],500);
                }
                $solicitud = (Plan_De_Accion_Individual::where('numero_Solicitud',$numsolicitud )->first());
                    if($solicitud->estado == 'Rechazado' || $solicitud->estado == 'Terminado'){
                        return response()->json([
                            "status" => false,
                            "error" => "Esta solicitud ya no puede ser editada",
                            ],400);
                    }
                    $solicitud->Estudiante->agregarProfesorConsejero(new Estudiante($request['Estudiante'])); 
                    
                        $status = $this->updatePAI($solicitud,$request['PAI']);
                            if($status){
                                 $status = $solicitud->Curso_Rezago->i_update($solicitud, $request['Curso']);   
                                 if($status){
                                     $status = $solicitud->Curso_Rezago->add_ActitudEstudiante($solicitud, $request['Actitud_En_El_Curso']);   
                                        if($status){
                                            $status = $this->update_Salud($solicitud, $request['Salud']);  
                                                if($status){
                                                    $status = $solicitud->Curso_Rezago->add_Formulario($solicitud, $request['Formulario']);
                                                    if($status){
                                                             $solicitud->Bitacora->createinput([
                                                                'descripcion'=> 'Se da el seguimiento adecuado de la solicitud, fecha: ' .  Carbon::now(),
                                                                 'acciones_realizadas' => 'Seguimiento solicitud' ,
                                                                  'observaciones' => 'No aplica']);
                                                                  $solicitud->save();
                                                                  $this->sendEmail($solicitud, 'update');
                                                            return response()->json([
                                                                "status" => true,
                                                                "error" => 'Solicitud actualizada correctamente',
                                                                ],200);
                                                    }
                                                }
                                        }
                                    }
                            }

                   
                    return response()->json([
                        "status" => true,
                        "message" => $status['message'],
                        ],400);
                
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }   
        }

        public function updatePAI($object, $request){
            if($object != null){
                    $object->update($request);
                        return ["status" => true];
                           
            }else{
                return [
                    "status" => false,
                    "error" => "No existe la solicitud.",
                ];
            }
        }

        public function updateStatus($numSolicitud, $status){
            try {
                if(!Plan_De_Accion_Individual::where('numero_Solicitud', $numSolicitud)->exists()){
                    return response()->json([
                      "status" => false,
                      "error" => "La solicitud ingresada no existe en el sistema",
                      ],500);
                }
                $solicitud = (Plan_De_Accion_Individual::where('numero_Solicitud',$numSolicitud )->first());
                    if($solicitud->estado == 'Rechazado' || $solicitud->estado == 'Terminado'){
                        return response()->json([
                            "status" => false,
                            "error" => "Esta solicitud ya no puede ser editada",
                            ],400);
                    }
                    $solicitud->estado = $this->newStatus($status['nuevo_Estado']);
                    $solicitud->save();
                        if($this->newStatus($status['nuevo_Estado']) == 'Rechazado'){
                           $solicitud = $this->changeNumRequest($numSolicitud);
                        }
                        update_statu_PAI::dispatch($solicitud, $status);
                    return response()->json([
                        "status" => true,
                        "message" => "El nuevo estado a sido actualizado",
                        ],200);
                
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function update_Salud($object, $request){
            if($object->Salud_Fisica_Emocional->update($request)){ 
                            return [
                                "status" => true,
                            ];
                    }else{
                        return [
                        "status" => false, "message" => "Error al actualizar la salud"
                                ];
                    }
            }

        private function changeNumRequest($numSolicitud){
            $solicitud = (Plan_De_Accion_Individual::where('numero_Solicitud',$numSolicitud )->first());
                for ($i=0; $i < 100; $i++) { 
                        $busqueda = $i === 0 ? $numSolicitud . 'Rechazado' : $numSolicitud . 'Rechazado' . $i;
                    if(!Plan_De_Accion_Individual::where('numero_Solicitud',$busqueda)->exists()){
                        $solicitud->update(['numero_Solicitud' => $busqueda]);
                        $solicitud->save();
                        $i=101;
                    }
                }
            return $solicitud->Revision_Solicitud;
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

    //Relaciones
    public function Administrador()
    {
        return $this->belongsTo(Administrador::class, 'administrador_Id', 'id');
    }
    public function Curso_Rezago()
    {
        return $this->hasOne(Curso_Rezago::class, 'solicitud_Numero', 'numero_Solicitud');
    }
    public function Salud_Fisica_Emocional()
    {
        return $this->hasOne(Salud_Fisica_Emocional::class, 'plan_De_Accion_N_Solicitud', 'numero_Solicitud');
    }
    public function Carrera_UCR()
    {
        return $this->belongsTo(Carrera_UCR::class, 'carrera_Id', 'id');
    }
    public function Archivos()
    {
        return $this->hasMany(Archivos::class, 'plan_De_Accion_Id', 'id');
    }
    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_Carnet', 'carnet');
    }

    public function Bitacora()
    {
        return $this->hasOne(Bitacora::class,'pai_Solicitud_Id', 'id');
    }
    public function Informe()
    {
        return $this->hasOne(Item_Informe::class,'pai_Solicitud_Id', 'id');
    }
}
