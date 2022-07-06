<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente_Plan_De_Accion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'numero_Solicitud',
        'fecha',
    ];

    protected $id;
    protected $numero_Solicitud;
    protected $fecha;

    public function Administrador()
    {
        return $this->belongsTo(Administrador::class);	
    }

    public function Valoracion()
    {
        return $this->hasOne(Valoracion::class);
    }
    public function Plan_De_Intervencion()
    {
        return $this->hasOne(Plan_De_Intervencion::class);
    }
    public function Plan_De_Accion_Individual()
    {
        return $this->hasOne(Plan_De_Accion_Individual::class);
    }
    public function Informe_Solicitud()
    {
        return $this->hasMany(Informe_Solicitud::class);
    }
    public function Bitacora()
    {
        return $this->hasMany(Bitacora::class);
    }
    public function Grupo_Familiar()
    {
        return $this->hasMany(Grupo_Familiar::class);
    }
}
