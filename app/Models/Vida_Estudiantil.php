<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vida_Estudiantil extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'plan_De_Accion_Id ',
        'profesional_Encargado',
        'horario_Atencion',
    ];

    protected $id;
    protected $plan_De_Accion_Id ;
    protected $profesional_Encargado;
    protected $horario_Atencion;
    
    public function Plan_De_Accion_Individual()
    {
        return $this->hasMany(Plan_De_Accion_Individual::class);
    }

    public function Contacto()
    { 
        return $this->hasOne(Contacto::class);
    }
    public function Email()
    { 
        return $this->hasOne(Email::class);
    }
}
