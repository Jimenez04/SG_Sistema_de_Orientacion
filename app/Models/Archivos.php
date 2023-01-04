<?php

namespace App\Models;

use App\Events\request_Adequacy;
use App\Events\request_PAI;
use App\Events\resume_PAI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class Archivos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'adecuacion_Solicitud_Id',
        'plan_De_Accion_Id',
        'url',
        'expedido_Por',
        'nombre',
    ];

    public function addfromReques($object, $request){
        try {
            if($object == null){
                return ['status' => false, 'message' => 'Error interno'];
            } 
        foreach ($request['archivos'] as $archivo) {
            $namefile = $archivo['nombre'] . $object->numero_solicitud . ".txt";
            Storage::disk('public')->put($namefile, $archivo['archivo64']);
            $archivo+=["url" => $namefile];
            $archivo+=["expedido_Por" => $archivo['expedidoPor']];
            $object->Archivos()->save(new Archivos($archivo)); 
        }
        return ["status"=>true];
        } catch (\Throwable $th) {
            return false;
        }
    }
    
     public function obtenerarchivos($numsolicitud, $tipo){
        try {
            $solicitudadecuacionparcial = null;
            if($tipo == 'adecuacion' ){
                if(!SolicitudDeAdecuacion::where('numero_solicitud', $numsolicitud)->exists()){
                    return response()->json([
                        "status" => false,
                        "error" => "La solicitud ingresada no existe en el sistema",
                        ],500);
                  }
                  $solicitudadecuacionparcial = (SolicitudDeAdecuacion::where('numero_solicitud', $numsolicitud)->first());
            }else{
                if(!Plan_De_Accion_Individual::where('numero_Solicitud', $numsolicitud)->exists()){
                    return response()->json([
                      "status" => false,
                      "error" => "La solicitud ingresada no existe en el sistema",
                      ],500);
                }
                $solicitudadecuacionparcial = (Plan_De_Accion_Individual::where('numero_Solicitud', $numsolicitud)->first());
            }
           return $this->PDF($solicitudadecuacionparcial, $tipo);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    public function PDF($solicitudadecuacionparcial, $tipo){
        return $tipo == 'adecuacion' ? $this->PDFAdecuacion($solicitudadecuacionparcial) : $this->PDFPAI($solicitudadecuacionparcial);
    }
   
    public function PDFAdecuacion($solicitudadecuacionparcial){
        $arvhico = [];
          foreach($solicitudadecuacionparcial->Archivos as $archivo){
            array_push($arvhico, [ 'pdf' => Storage::disk('public')->get($archivo->url), 'nombre' => $archivo->nombre .".pdf" ]);
          }
            if("Administrador" == Auth::user()->role->role){
                $solicitud = $solicitudadecuacionparcial;
                $PDFrequest = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('adequacy', compact("solicitud"))->setPaper('letter');
                array_push($arvhico, [ 'pdf' => base64_encode($PDFrequest->output()), 'nombre' => $solicitudadecuacionparcial->numero_solicitud . ".pdf" ]);
            }
          return response()->json([
            "status" => true,
            'data' => $arvhico,
            "error" => '',
            ],200);
    }
    public function PDFPAI($solicitudadecuacionparcial){
        $arvhico = [];
        $tipo = 'user';
        if("Administrador" == Auth::user()->role->role){
            $tipo = 'admin';
        }
        $PDFrequest = $this->makePDF($solicitudadecuacionparcial, $tipo == 'user' ? 'PAI' : 'PAIAdmin');
        array_push($arvhico, [ 'pdf' => base64_encode($PDFrequest->output()), 'nombre' => $solicitudadecuacionparcial->numero_Solicitud . ".pdf" ]);
        return response()->json([
            "status" => true,
            'data' => $arvhico,
            "error" => '',
            ],500);
    }
    
    public function makePDF($solicitud, $vista){
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView($vista, compact("solicitud"))->setPaper('letter');
        return $pdf;
    }


    public function Solicitud_De_Adecuacion()
    {
        return $this->belongsTo(Solicitud_De_Adecuacion::class,'adecuacion_Solicitud_Id', 'id' );
    }

    public function Plan_De_Accion_Individual()
    {
        return $this->belongsTo(Plan_De_Accion_Individual::class,'plan_De_Accion_Id', 'id' );
    }
}

