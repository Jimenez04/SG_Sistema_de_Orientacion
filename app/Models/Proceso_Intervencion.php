<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso_Intervencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'id_Plan_Intervencion',
        'area_Intervencion',
        'descripcion',  
       
      
    ];

    protected $id;
    protected $id_Plan_Intervencion;
    protected $area_Intervencion;
    protected $descripcion;

    public function Plan_Intervencion()
    {
        return $this->belongsTo(Plan_Intervencion::class);
    }

}
