<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe_Solicitud extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'fecha',
        'descripcion',
        'informe_Solicitud_Id',
    ];
    protected $primaryKey = 'id';

    public function item_Informe(){
        return $this->hasMany(Item_Informe::class, 'informe_Id', 'id' );
    }
}
