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

    protected $id;
    protected $revision_Solicitud_Id;
    protected $expediente_Solicitud_Id;
    protected $informe_Id;

    public function Informe_Solicitud()
    {
        return $this->belongsTo(Informe_Solicitud::class);
    }
}
