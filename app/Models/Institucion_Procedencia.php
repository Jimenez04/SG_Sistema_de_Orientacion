<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion_Procedencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'ano_egreso',
        'solicitud_Numero',
    ];

    protected $id;
    protected $nombre;
    protected $ano_egreso;
    protected $solicitud_Numero;

    public function SolicitudDeAdecuacion()
    {
        return $this->hasMany(SolicitudDeAdecuacion::class);
    }
}
