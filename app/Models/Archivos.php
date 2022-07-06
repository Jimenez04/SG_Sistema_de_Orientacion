<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'numero_solicitud',
        'url',
        'expedido_Por',
    ];

    protected $id;
    protected $numero_solicitud;
    protected $url;
    protected $expedido_Por;

    public function Solicitud_De_Adecuacion()
    {
        return $this->belongsTo(Solicitud_De_Adecuacion::class);
    }

    public function Plan_De_Accion_Individual()
    {
        return $this->hasOne(Plan_De_Accion_Individual::class);
    }
}
