<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'id_Expediente_Plan_De_Accion',
        'fecha',
        'persona_Solicitante_Plan_De_Accion', 
        'motivo_Intervencion', 
        'resumen_Valoracion', 
    ];

    protected $id;
    protected $id_Expediente_Plan_De_Accion;
    protected $fecha;
    protected $persona_Solicitante_Plan_De_Accion;
    protected $motivo_Intervencion;
    protected $resumen_Valoracion;

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class);
    }

}
