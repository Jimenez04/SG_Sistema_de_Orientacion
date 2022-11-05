<?php

namespace App\Models;

use App\Events\update_status_Request_adequacy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision_Solicitud extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'fecha',
        'estado',
        'administrador_Cedula',
        'solicitud_Numero',
        
    ];


    public function create_NewRequest($solicitud){
        $revision = new Revision_Solicitud([
            "solicitud_Numero" => $solicitud->numero_solicitud,
            "estado" => "Enviado para su revisión",
            "fecha" => Carbon::now(),
        ]);
        $admin = Administrador::find(1);
        $admin->Revision_Solicitud()->save($revision);
    }



    //Observaciones
    public function getAll_Observation($numSolicitud){
        try{
            $observacion = new Observacion();
                return $observacion->get_all((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function get_Observation($numSolicitud, $id){
        try{
            $observacion = new Observacion();
                return $observacion->get((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $id);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function delete_Observation($numSolicitud, $id){
        try{
            $observacion = new Observacion();
                return $observacion->delete_e((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $id);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function update_Observation($numSolicitud, $id, $request){
        try{
            $observacion = new Observacion();
                return $observacion->update_e((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $request, $id);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function  addObservation($numSolicitud, $observationRequest){
        try {
          $obervacion = new Observacion();
          if(!SolicitudDeAdecuacion::where('numero_solicitud', $numSolicitud)->exists()){
            return response()->json([
              "status" => false,
              "error" => "La solicitud ingresada no existe en el sistema",
              ],500);
          }
            $observacion = $obervacion->add((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $observationRequest);
              if($observacion['status']){
                  return response()->json([
                    "status" => true,
                    "message" => "La Observación fue agregada correctamente",
                    ],200);
              }
            return response()->json(['status' => false , 'message' => 'Error', 'data' => $observacion['message']],400);  
        } catch (\Throwable $th) {
            return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
            }   
      }
       //End Observaciones

       //recomendaciones
    public function getAll_recommendation($numSolicitud){
        try{
            $observacion = new Recomendaciones();
                return $observacion->get_all((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function get_recommendation($numSolicitud, $id){
        try{
            $observacion = new Recomendaciones();
                return $observacion->get((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $id);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function delete_recommendation($numSolicitud, $id){
        try{
            $observacion = new Recomendaciones();
                return $observacion->delete_e((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $id);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function update_recommendation($numSolicitud, $id, $request){
        try{
            $observacion = new Recomendaciones();
                return $observacion->update_e((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $request, $id);
        }catch(\Throwable $th) {
          return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
          }
    }

    public function  addrecommendation($numSolicitud, $recommendationRequest){
        try {
          $obervacion = new Recomendaciones();
          if(!SolicitudDeAdecuacion::where('numero_solicitud', $numSolicitud)->exists()){
            return response()->json([
              "status" => false,
              "error" => "La solicitud ingresada no existe en el sistema",
              ],500);
          }
            $observacion = $obervacion->add((SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud, $recommendationRequest);
              if($observacion['status']){
                  return response()->json([
                    "status" => true,
                    "message" => "La Observación fue agregada correctamente",
                    ],200);
              }
            return response()->json(['status' => false , 'message' => 'Error', 'data' => $observacion['message']],400);  
        } catch (\Throwable $th) {
            return response()->json([
              "status" => false,
              "error" => $th->getMessage(),
              ],500);
            }   
      }
       //End recomendaciones

       //Status
        public function updateStatus($numSolicitud, $status){
            try {
                if(!SolicitudDeAdecuacion::where('numero_solicitud', $numSolicitud)->exists()){
                    return response()->json([
                      "status" => false,
                      "error" => "La solicitud ingresada no existe en el sistema",
                      ],500);
                }
                $revision = (SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first())->Revision_Solicitud;
                    if($revision->estado == 'Rechazado' || $revision->estado == 'Terminado'){
                        return response()->json([
                            "status" => false,
                            "error" => "Esta solicitud ya no puede ser editada",
                            ],400);
                    }
                    $revision->estado = $this->newStatus($status->nuevo_Estado);
                    $revision->save();
                        if($this->newStatus($status->nuevo_Estado) == 'Rechazado'){
                           $revision = $this->changeNumRequest($numSolicitud);
                        }
                        update_status_Request_adequacy::dispatch($revision->Solicitud_Adecuacion, $status->descripcion_Rechazado);
                    return response()->json([
                        "status" => true,
                        "error" => "El nuevo estado a sido actualizado",
                        ],200);
                
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        private function changeNumRequest($numSolicitud){
            $solicitud = (SolicitudDeAdecuacion::where('numero_solicitud',$numSolicitud )->first());
                for ($i=0; $i < 100; $i++) { 
                        $busqueda = $i === 0 ? $numSolicitud . 'Rechazado' : $numSolicitud . 'Rechazado' . $i;
                    if(!SolicitudDeAdecuacion::where('numero_solicitud',$busqueda)->exists()){
                        $solicitud->update(['numero_solicitud' => $busqueda]);
                        $solicitud->save();
                    }
                }
            return $solicitud->Revision_Solicitud;
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

       //End Status

    public function Solicitud_Adecuacion(){
        return $this->belongsTo(SolicitudDeAdecuacion::class, 'solicitud_Numero', 'numero_solicitud');
    }

    public function Administrador()
    {
        return $this->belongsTo(Administrador::class, 'administrador_Id', 'id');
    }

    public function Observacion()
    {
        return $this->hasMany(Observacion::class, 'revision_Solicitud_id', 'id');
    }
    public function Recomendaciones()
    {
        return $this->hasMany(Recomendaciones::class, 'revision_Solicitud_id', 'id');
    }
    public function Informe_Solicitud()
    {
        return $this->hasOne(Informe_Solicitud::class);
    }
    public function Bitacora()
    {
        return $this->hasOne(Bitacora::class,'revision_Solicitud_Id', 'id');
    }
}
