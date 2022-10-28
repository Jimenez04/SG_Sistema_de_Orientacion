<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'fecha',
        'revision_Solicitud_Id',
        'expediente_Solicitud_Id',
        'bitacora_Id'
    ];
    protected $primaryKey = 'id';

    //Only Request of adequacy
    public function new_FromRequest($object, $field, $typerequest){
        $bitacora = new Bitacora([
            $field => $object->id,
            "fecha" => Carbon::now(),
        ]);
        $bitacora->save();
            $this->createInputFromRequest($object, $typerequest);
    }

    public function createInputFromRequest($object, $typerequest){
        switch ($typerequest) {
            case 'Adecuacion':
                $numerosolicitud = $object->Solicitud_Adecuacion->numero_solicitud;
                $estudiante = $object->Solicitud_Adecuacion->Estudiante;
                break;
            default:
                # code...
                break;
        }
        
        $descripcion = "Se da inicio a la solicitud número: ". $numerosolicitud .", el día:". Carbon::now() ." , por el estudiante: $estudiante->carnet. La presente se encuentra en estaba de aprobación.";

        $accionesrealizadas = "Inicio de la solicitud número: ". $numerosolicitud .", notificación al estudiante de su solicitud, notificación al estudiante del estado actual de su solicitud.";

        $observaciones = "No presenta.";
        $item = new Item_Bitacora();
        $item->newInput(
            $object->Bitacora->id,
            $descripcion,
            $accionesrealizadas,
            $observaciones
        );
    }

    public function addItem($item){
            $this->item_Bitacora()->save($item);
    }

    //relaciones
    public function Revision_Solicitud()
    {
        return $this->belongsTo(Revision_Solicitud::class, 'revision_Solicitud_Id', 'id');
    }
    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class, 'expediente_Solicitud_Id', 'id' );
    }
    public function item_Bitacora()
    {
        return $this->hasMany(Item_Bitacora::class, 'bitacora_Id', 'id' );
    }

}
