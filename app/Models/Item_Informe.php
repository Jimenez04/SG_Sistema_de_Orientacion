<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Informe extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'revision_Solicitud_Id',
        'expediente_Solicitud_Id',
        'informe_Id',
        	
    ];
    protected $primaryKey = 'id';

    public function Informe_Solicitud()
    {
        return $this->belongsTo(Informe_Solicitud::class, 'informe_Id', 'id');
    }
    public function Revision_Solicitud(){
        return $this->belongsTo(Revision_Solicitud::class, 'revision_Solicitud_Id', 'id');
    }
    public function Expediente_Plan_De_Accion()
    {
        return $this->belongsTo(Expediente_Plan_De_Accion::class, 'expediente_Solicitud_Id', 'id' );
    }
}
