<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cierre_Intervencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'plan_Intervencions_Id',
        'especificacion_De_Cierre',
        'conclusiones_finales',  
        'recomendaciones',
        'fecha',
    ];
    protected $primaryKey = 'id';


    //relaciones
    public function Plan_De_Intervencion()
    {
        return $this->belongsTo(Plan_De_Intervencion::class, 'plan_Intervencions_Id', 'id');
    }

  
}

