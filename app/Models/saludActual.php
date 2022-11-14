<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saludActual extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'afectacionDesempeno',
        'enfermedad',
        'tratamiento',
        'adecuacion_Solicitud_Id',
    ];

    protected $primaryKey = 'id';

    public function add_($object, $request)
    {
        $salud = new saludActual($request['saludActual']);
            if($object != null){
                $object->addsalud($salud);
              return ['status' => true, 'message' => 'Creada correctamente'];
            }else{
                return ['status' => false, 'message' => 'Error interno'];
            }
    }

    public function Solicitud()
    {
        return $this->belongsTo(saludActual::class, 'adecuacion_Solicitud_Id', 'id');
    }
}
