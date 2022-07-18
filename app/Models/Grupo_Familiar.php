<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_Familiar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'descripcion_De_Discapacidades',
        'adecuacion_Solicitud_Id',
        'expediente_Solicitud_Id'
    ];
    protected $primaryKey = 'id';

    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class, 'expediente_Solicitud_Id', 'id' );
    }
    public function Solicitud_De_Adecuacion()
    {
        return $this->belongsTo(Solicitud_De_Adecuacion::class, 'adecuacion_Solicitud_Id', 'id');
    }

    public function Pariente()
    {
        return $this->hasMany(Pariente::class, 'grupo_Familiar_Id', 'id');
    }
}
