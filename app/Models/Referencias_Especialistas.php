<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencias_Especialistas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'id_Proceso_Intervencion',
        'referencias',
        'descripcion',  
       
      
    ];

    protected $id;
    protected $id_Proceso_Intervencion;
    protected $referencias;
    protected $descripcion;

    public function Proceso_Intervencion()
    {
        return $this->belongsTo(Proceso_Intervencion::class);
    }
}
