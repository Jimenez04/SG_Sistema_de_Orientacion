<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salud_Fisica_Emocional extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_De_Accion_N_Solicitud',
        'descipcion',
    ];
    protected $primaryKey = 'plan_De_Accion_N_Solicitud';

    public function Plan_De_Accion_Individual()
    {
        return $this->belongsTo(Plan_De_Accion_Individual::class, 'plan_De_Accion_N_Solicitud', 'numero_Solicitud');
    }
    
}
