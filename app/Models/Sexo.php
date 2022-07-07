<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];
    protected $primaryKey = 'id';
    protected $id;
    protected $nombre;
    
    public function Persona()
    {
        return $this->hasMany(Persona::class, 'sexo_id', 'id');
    }

    public function getName()
    {
        return $this->nombre;
    }

    public function addPersonSex($persona)
    {
        return $this->Persona()->save($persona);
    }

    public function updatePersonSex($persona, $id_Sexo)
    {
         return $persona->updateSex($id_Sexo);
    }
}
