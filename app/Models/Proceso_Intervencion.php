<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso_Intervencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'plan__Intervencions_Id',
        'area_Intervencion',
        'descripcion',  
       
      
    ];

    protected $id;
    protected $plan__Intervencions_Id;
    protected $area_Intervencion;
    protected $descripcion;

    public function Plan_Intervencion()
    {
        return $this->belongsTo(Plan_Intervencion::class);
    }

}
