<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'revision_Solicitud_id',
    ];

    public function Revision_Solicitud()
    {
        return $this->belongsTo(Revision_Solicitud::class);
    }
}
