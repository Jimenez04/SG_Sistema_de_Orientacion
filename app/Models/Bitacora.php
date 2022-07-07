<?php

namespace App\Models;

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

    protected $id;
    protected $fecha;
    protected $revision_Solicitud_Id;
    protected $expediente_Solicitud_Id;
    protected $bitacora_Id;

    public function Revision_Solicitud()
    {
        return $this->belongsTo(Revision_Solicitud::class);
    }
    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class);
    }

}
