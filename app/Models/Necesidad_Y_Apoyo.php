<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Necesidad_Y_Apoyo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'solicitud_Numero',
        'diagnostico',
        'area_Profesional',
        'recibe_atencionyseguimiento',
        'atencionyseguimiento',
    ];

    public function add_($object, $request)
    {
        $necesidad = new Necesidad_Y_Apoyo($request['necesidad_Apoyo']);
            if($object != null){
                $object->addRNecesidadY_Apoyo($necesidad);
              return ['status' => true, 'message' => 'Creada correctamente'];
            }else{
                return ['status' => false, 'message' => 'Error interno'];
            }
    }

    public function SolicitudDeAdecuacion()
    {
        return $this->belongsTo(SolicitudDeAdecuacion::class, 'solicitud_Numero', 'numero_solicitud');	
    }
}
