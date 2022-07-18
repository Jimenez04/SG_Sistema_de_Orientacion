<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencias_Especialistas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'proceso_Intervencion_id',
        'referencias',
        'descripcion',  
    ];
    protected $primaryKey = 'id';


    //relaciones
    public function Proceso_Intervencion()
    {
        return $this->belongsTo(Proceso_Intervencion::class, 'proceso_Intervencion_id', 'id');
    }
}
