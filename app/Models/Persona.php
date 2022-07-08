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
            'sexo_id',
            'user_id',
            'trabajo_id',
        ];
        protected $primaryKey = 'cedula';
        protected $cedula;
        protected $nombre1;
        protected $nombre2;
        protected $apellido1;
        protected $apellido2;
        protected $fecha_Nacimiento;
        protected $sexo_id;
        protected $user_id;
        protected $trabajo_id;


        public function getNameSex()
        {
            return $this->Sexo()->get()->first()->nombre;
        }

        public function updateSex($id_Sexo){
           $this->update(['sexo_id' => $id_Sexo]);
        }


        //sickness
        public function addSickness($enfermedad){
            $this->Enfermedad()->save($enfermedad);
        }
        public function deletesickness($enfermedad){
            $this->Enfermedad()->find($enfermedad->id)->delete();
        }
        public function countSickness()
        {
            return $this->Enfermedad()->count();
        }
        //endsickness

         //contact
         public function addContact($contacto){
            $this->Contacto()->save($contacto);
        }
        public function countContact()
        {
            return $this->Contacto()->count();
        }
        //endcontact

         //email
         public function addEmail($contacto){
            $this->Email()->save($contacto);
        }
        public function countEmail()
        {
            return $this->Email()->count();
        }
        //endEmail

        //Studen
        public function associateStudent($estudiante){
            $this->Estudiante()->save($estudiante);
        }
        public function getStudentCarnet()
        {
            return $this->Estudiante()->get()->first()->attributes['carnet'];
        } 
        //endStuden

        //Admin
        public function associateAdmin($Admin){
            $this->Administrador()->save($Admin);
        }
        public function getAdminCedula()
        {
            return $this->Administrador()->get()->first()->attributes['persona_cedula'];
        } 
        //endAdmin

        public function User()
        {
            return $this->belongsTo(User::class);
        }

        public function Sexo()
        {
            return $this->belongsTo(Sexo::class);
        }
        public function Trabajo()
        {
            return $this->belongsTo(Trabajo::class);
        }
        public function Enfermedad()
        {
            return $this->hasMany(Enfermedad::class, 'persona_cedula', 'cedula');
        }
        public function Contacto()
        {
            return $this->hasMany(Contacto::class, 'persona_cedula', 'cedula');
        }
        public function Email()
        {
            return $this->hasMany(Email::class, 'persona_cedula', 'cedula');
        }
        public function Administrador()
        {
            return $this->hasOne(Administrador::class, 
            'persona_cedula', 'cedula');
        }
        public function Estudiante()
        {
            return $this->hasOne(Estudiante::class, 'persona_cedula', 'cedula');
        }

}
