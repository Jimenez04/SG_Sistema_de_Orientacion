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

    public function addfromReques($object, $request){
            if($object == null){
                return ['status' => false, 'message' => 'Error interno'];
            } 
        foreach ($request['archivos'] as $archivo) {
            $namefile = $archivo['nombre'] . $object->numero_solicitud . ".txt";
            Storage::disk('public')->put($namefile, $archivo['archivo64']);
            $archivo+=["url" => $namefile];
            $object->Archivos()->save(new Archivos($archivo)); 
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

