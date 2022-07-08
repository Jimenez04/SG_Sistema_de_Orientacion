<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan_Intervencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'expediente_Plan_De_Accion_Id',
        'accion_Planificada',
        'cronograma',  
        'estado',
        'observaciones',
      
    ];

    protected $id;
    protected $expediente_Plan_De_Accion_Id;
    protected $accion_Planificada;
    protected $cronograma;
    protected $estado;
    protected $observaciones;

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class);
    }

    public function Participante()
    {
        return $this->hasOne(Participante::class);
    }
    public function Cierre_Intervencion()
    {
        return $this->hasOne(Cierre_Intervencion::class);
    }
    public function Proceso_Intervencion()
    {
        return $this->hasOne(Proceso_Intervencion::class);
    }
}
