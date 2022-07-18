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
    
    //relaciones
    public function Plan_De_Accion_Individual()
    {
        return $this->belongsTo(Plan_De_Accion_Individual::class, 'plan_De_Accion_Id', 'id');
    }

    public function Contacto()
    { 
        return $this->hasOne(Contacto::class, 'vida_Estudiantil_Id', 'id' );
    }
    public function Email()
    { 
        return $this->hasOne(Email::class, 'vida_Estudiantil_Id', 'id');
    }
}
