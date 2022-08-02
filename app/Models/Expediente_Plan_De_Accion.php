<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente_Plan_De_Accion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'solicitud_Numero',
        'administrador_Cedula',
        'fecha',
    ];
    protected $primaryKey = 'id';


    //relaciones
    public function Administrador()
    {
        return $this->belongsTo(Administrador::class,'administrador_Id', 'id');	
    }
    public function Valoracion()
    {
        return $this->hasOne(Valoracion::class, 'id_Expediente_Plan_De_Accion', 'id');
    }
    public function Plan_De_Intervencion()
    {
        return $this->hasOne(Plan_De_Intervencion::class, 'expediente_Plan_De_Accion_Id', 'id');
    }
    public function Plan_De_Accion_Individual()
    {
        return $this->belongsTo(Plan_De_Accion_Individual::class, 'solicitud_Numero', 'numero_Solicitud');
    }
    public function item_Informe()
    {
        return $this->hasMany(item_Informe::class, 'expediente_Solicitud_Id', 'id');
    }
    public function Bitacora()
    {
        return $this->hasMany(Bitacora::class, 'expediente_Solicitud_Id', 'id');
    }
    public function Grupo_Familiar()
    {
        return $this->hasOne(Grupo_Familiar::class, 'expediente_Solicitud_Id', 'id');
    }
}
