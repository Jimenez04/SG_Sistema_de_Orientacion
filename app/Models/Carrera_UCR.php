<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera_UCR extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'coordinador',
        'telefono',
        'bloques', 
        'creditos',
    ];

    public function Carrera()
    {
        return $this->hasMany(Carrera::class, 'carrera_id', 'id');
    }
    public function CursosUCR()
    {
        return $this->hasMany(CursosUCR::class, 'carrera_id', 'id');
    }
    public function SolicitudPAI()
    {
        return $this->hasMany(Plan_De_Accion_Individual::class, 'carrera_Id', 'id');
    }
}
