<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision_Solicitud extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'fecha',
        'estado',
        'administrador_Cedula',
        'solicitud_Numero',
        'revision_Solicitud_id',
        
    ];

    protected $id;
    protected $fecha;
    protected $estado;
    protected $administrador_Cedula;
    protected $solicitud_Numero;
    protected $revision_Solicitud_id;


    public function Solicitud_Adecuacion(){
        return $this->hasOne(Solicitud_Adecuacion::class);
    }
    public function Administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

    public function Observacion()
    {
        return $this->hasMany(Observacion::class);
    }
    public function Recomendaciones()
    {
        return $this->hasMany(Recomendaciones::class);
    }
    public function Informe_Solicitud()
    {
        return $this->hasOne(Informe_Solicitud::class);
    }
    public function Bitacora()
    {
        return $this->hasOne(Bitacora::class);
    }
}
