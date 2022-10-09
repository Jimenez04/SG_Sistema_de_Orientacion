<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function addfromReques($numsolicitud, $request){
            if(SolicitudDeAdecuacion::where('numero_solicitud', $numsolicitud)->exists()){
                $solicitud = (SolicitudDeAdecuacion::where('numero_solicitud', $numsolicitud)->first());
            }else{
                return ['status' => false, 'message' => 'Error interno'];
            } 
        foreach ($request['archivos'] as $archivo) {
            //$link = Storage::disk('public')->put($archivo['nombrePDF'] . $numsolicitud . ".txt" ,$archivo['archivo64']);
            $link = Storage::disk('local')->put('example.txt', 'Contents');
            $archivo+=["url" => $link];
            dd($archivo);
            // $parientemodel =  new Pariente($pariente);
            //$grupofamiliar->Pariente()->save($parientemodel); 
        }
        return ["status"=>true];
        
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

