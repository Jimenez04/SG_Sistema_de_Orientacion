<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Bitacora extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'descripcion',
        'fecha',
        'bitacora_Id',
        
    ];

    protected $id;
    protected $fecha;
    protected $descripcion;
    protected $bitacora_Id;
   
    public function Bitacora()
    {
        return $this->belongsTo(Bitacora::class);
    }
}
