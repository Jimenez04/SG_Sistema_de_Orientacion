<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_Familiar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'numero_solicitud',
        'descripcion_De_Discapacidades',
    ];


    protected $id;
    protected $numero_solicitud;
    protected $descripcion_De_Discapacidades;

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class);
    }
    public function Solicitud_De_Adecuacion()
    {
        return $this->belongsTo(Solicitud_De_Adecuacion::class);
    }

    public function Pariente()
    {
        return $this->hasOne(Pariente::class);
    }
}
