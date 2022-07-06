<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe_Solicitud extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'fecha',
        'descripcion',
        'informe_Solicitud_Id',
    ];

    protected $id;
    protected $fecha;
    protected $descripcion;
    protected $informe_Solicitud_Id;


    public function Revision_Solicitud(){
        return $this->belongsTo(Revision_Solicitud::class);
    }
    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class);
    }
}
