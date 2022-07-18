<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'necesidad_Y_Apoyo_id',
        'descripcion_Seguimiento',
        'descripcion_Atencion', 
    ];

    public function Necesidad_Y_Apoyo()
    {
        return $this->belongsTo(Necesidad_Y_Apoyo::class, 'necesidad_Y_Apoyo_id', 'id' );
    }

}
