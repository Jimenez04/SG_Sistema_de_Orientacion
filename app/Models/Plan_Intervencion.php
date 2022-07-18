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
    protected $primaryKey = 'id';

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class, 'expediente_Plan_De_Accion_Id', 'id' );
    }

    public function Participante()
    {
        return $this->hasMany(Participante::class, 'plan__Intervencion_Id', 'id');
    }
    public function Cierre_Intervencion()
    {
        return $this->hasOne(Cierre_Intervencion::class, 'plan_Intervencions_Id', 'id' );
    }
    public function Proceso_Intervencion()
    {
        return $this->hasOne(Proceso_Intervencion::class, 'plan__Intervencions_Id', 'id');
    }
}
