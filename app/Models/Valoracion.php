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
        'persona_Solicitante_Plan_DeAccion', 
        'motivo_Intervencion', 
        'resumen_Valoracion', 
    ];
    protected $primaryKey = 'id';

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class, 'id_Expediente_Plan_De_Accion' , 'id');
    }

}
