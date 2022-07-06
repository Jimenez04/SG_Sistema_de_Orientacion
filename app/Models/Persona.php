<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
        use HasFactory;

        protected $fillable = [
            'cedula',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'fecha_Nacimiento',
            'id_Sexo',
            'user_id',
            'trabajo_id',
        ];
        protected $cedula;
        protected $nombre1;
        protected $nombre2;
        protected $apellido1;
        protected $apellido2;
        protected $fecha_Nacimiento;
        protected $id_Sexo;
        protected $user_id;
        protected $trabajo_id;

        public function User()
        {
            return $this->hasOne(User::class);
        }
        public function Sexo()
        {
            return $this->hasOne(Sexo::class);
        }
        public function Trabajo()
        {
            return $this->hasOne(Trabajo::class);
        }
        public function Enfermedad()
        {
            return $this->hasMany(Enfermedad::class);
        }
        public function Contacto()
        {
            return $this->hasMany(Contacto::class);
        }
        public function Email()
        {
            return $this->hasMany(Email::class);
        }
        public function Administrador()
        {
            return $this->belongsTo(Administrador::class);
        }
        public function Estudiante()
        {
            return $this->belongsTo(Estudiante::class);
        }

}
