<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion_Procedencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'ano_egreso',
        'solicitud_Numero',
        'ano_ingreso_universidad',
    ];

    public function add_($object, $request)
    {
        $institucion = new Institucion_Procedencia($request['institucion']);
            if($object != null){
                $object->addInstitucion($institucion);
              return ['status' => true, 'message' => 'Creado correctamente'];
            }else{
                return ['status' => false, 'message' => 'Error interno'];
            }
    }

    public function SolicitudDeAdecuacion()
    {
        return $this->belongsTo(SolicitudDeAdecuacion::class, 'solicitud_Numero', 'numero_solicitud');
    }
}
