<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_Familiar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'descripcion_De_Discapacidades',
        'adecuacion_Solicitud_Id',
        'expediente_Solicitud_Id'
    ];
    protected $primaryKey = 'id';

    public function addfromReques($solicitud, $request){
        $grupofamiliar = new Grupo_Familiar($request['grupoFamiliar']);
            if(SolicitudDeAdecuacion::where('numero_solicitud', $solicitud)->exists()){
                $solicitud = (SolicitudDeAdecuacion::where('numero_solicitud', $solicitud)->first());
            }else{
                return ['status' => false, 'message' => 'Error interno'];
            } 
        $solicitud->Grupo_Familiar()->save($grupofamiliar);
        foreach ($request['grupoFamiliar']['pariente'] as $pariente) {
            $parientemodel =  new Pariente($pariente);
            $grupofamiliar->Pariente()->save($parientemodel); 
        }
        return ["status"=>true];
        
    }

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class, 'expediente_Solicitud_Id', 'id' );
    }
    public function Solicitud_De_Adecuacion()
    {
        return $this->belongsTo(Solicitud_De_Adecuacion::class, 'adecuacion_Solicitud_Id', 'id');
    }

    public function Pariente()
    {
        return $this->hasMany(Pariente::class, 'grupo_Familiar_Id', 'id');
    }
}
