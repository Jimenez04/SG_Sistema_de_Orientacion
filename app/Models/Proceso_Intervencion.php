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
    protected $primaryKey = 'id';

    //relaciones
    public function Plan_Intervencion()
    {
        return $this->belongsTo(Plan_Intervencion::class, 'plan__Intervencions_Id', 'id');
    }
    public function referencias_Especialistas()
    {
        return $this->hasMany(Plan_Intervencion::class, 'proceso_Intervencion_id', 'id');
    }

}
