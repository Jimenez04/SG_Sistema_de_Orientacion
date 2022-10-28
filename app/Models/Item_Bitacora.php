<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Bitacora extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'descripcion',
        'acciones_realizadas',
        'observaciones',
        'fecha',
        'bitacora_Id',
        
    ];

    public function newInput($idBitacora, $descripcion, $acciones_realizadas, $observaciones)
    {
        $item = new Item_Bitacora([
            "descripcion" => $descripcion,
            "acciones_realizadas" => $acciones_realizadas,
            "observaciones" => $observaciones,
            "fecha" => Carbon::now(),
        ]);
        $bitacora =  Bitacora::find($idBitacora);
        $bitacora->addItem($item);
    }
   
    public function Bitacora()
    {
        return $this->belongsTo(Bitacora::class, 'bitacora_Id' , 'id');
    }
}
