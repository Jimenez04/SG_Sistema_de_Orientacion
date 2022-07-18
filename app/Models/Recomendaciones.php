<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recomendaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre_Especialista',
        'descripcion_Recomendacion',
        
    ];

    public function Revision_Solicitud()
    {
        return $this->belongsTo(Revision_Solicitud::class);
    }

    
}
