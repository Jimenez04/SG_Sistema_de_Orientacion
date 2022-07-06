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


    protected $id;
    protected $nombre;
    protected $coordinador;
    protected $telefono;
    protected $bloques;
    protected $creditos;

    public function Carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
    public function CursosUCR()
    {
        return $this->hasMany(CursosUCR::class);
    }
}
