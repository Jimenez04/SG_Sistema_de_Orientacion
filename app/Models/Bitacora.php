<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'fecha',
        'revision_Solicitud_Id',
        'expediente_Solicitud_Id',
        'bitacora_Id'
    ];
    protected $primaryKey = 'id';

    //relaciones
    public function Revision_Solicitud()
    {
        return $this->belongsTo(Revision_Solicitud::class, 'revision_Solicitud_Id', 'id');
    }
    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class, 'expediente_Solicitud_Id', 'id' );
    }
    public function item_Bitacora()
    {
        return $this->hasMany(Item_Bitacora::class, 'bitacora_Id', 'id' );
    }

}
