<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salud_Fisica_Emocional extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'numero_Solicitud',
        'descripcion',
    
    ];

    protected $id;
    protected $numero_Solicitud;
    protected $descripcion;

    public function Plan_De_Accion_Individual()
    {
        return $this->belongsTo(Plan_De_Accion_Individual::class);
    }
    
}
