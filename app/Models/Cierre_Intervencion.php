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

    protected $id;
    protected $plan_Intervencions_Id;
    protected $especificacion_De_Cierre;
    protected $conclusiones_finales;
    protected $recomendaciones;
    protected $fecha;

    public function Plan_De_Intervencion()
    {
        return $this->belongsTo(Plan_De_Intervencion::class);
    }

  
}

