<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cierre_Intervencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'id_Plan_Intervencion',
        'especificacion_De_Cierre',
        'conclusiones_Finales',  
        'recomendaciones',
        'fecha',
      
    ];

    protected $id;
    protected $id_Plan_Intervencion;
    protected $especificacion_De_Cierre;
    protected $conclusiones_Finales;
    protected $recomendaciones;
    protected $fecha;

    public function Plan_De_Intervencion()
    {
        return $this->belongsTo(Plan_De_Intervencion::class);
    }

  
}
