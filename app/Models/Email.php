<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',  
        'email',
        'persona_cedula',
        'vida_Estudiantil_Id', 
    ];


    protected $id;
    protected $email;
    protected $persona_cedula;
    protected $vida_Estudiantil_Id;

    public function Persona()
    {
        return $this->belongsTo(Persona::class);
    }

     public function vida_Estudiantil()
    {
         return $this->belongsTo(vida_Estudiantil::class);
    }

}
