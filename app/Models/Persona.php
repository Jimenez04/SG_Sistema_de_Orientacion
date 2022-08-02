<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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

        public function allPersons(){
            try {
                $persons = Persona::all();
                   return response()->json([
                   "success" => true,
                   "message" => "Lista de Personas",
                   "data" => $persons
                   ],200);
            } catch (\Throwable $th) {
                return response()->json([
                    "success" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function newperson($request)
        {
            try {
                if($this->validate_cedula_DB($request['cedula'])){
                        if($this->belong_to_user($request['cedula'])){
                            return response()->json([
                                "status" => false,
                                "error" => "La cédula ya esta asociada a un usuario", //Persona ocupada
                                ],409);
                        }
                        return response()->json([
                            "status" => 3,
                            "error" => "La cédula ya se encuentra en uso", //persona existente, sin usuario
                            ],409);
                }
                    $persona = Persona::create([
                        'cedula' => $request['cedula'],
                        'nombre1' => $request['nombre1'],
                        'nombre2' => $request['nombre2'],
                        'apellido1' => $request['apellido1'],
                        'apellido2' => $request['apellido2'],
                        'fecha_Nacimiento' => $request['fecha_Nacimiento'],
                    ]);
                    $persona->save();
                    
                    $persona->addEmail($request['cedula'], $request['email']); //En caso que sea un nuevo usuario
                    $this->addSex($request['sexo_id'], $persona);

                        return response()->json([
                            "status" => true,
                            "message" => "Persona creada correctamente. OK",
                            ],200);
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(), 
                    ],200);
            }
        }

        private function belong_to_user($cedula){
            $persona = Persona::find($cedula);
            return $persona->User()->exists();
        }

        private function validate_cedula_DB($cedula){
                return Persona::where('cedula', $cedula)->exists();
        }

        //sex
        public function getNameSex()
        {
            return $this->Sexo()->get()->first()->nombre;
        }

        public function addSex($id_Sexo, $persona){
                $sexo = Sexo::find($id_Sexo);
                $sexo->addPersonSex($persona);
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
         public function addEmail($cedula, $request){
            $persona = Persona::where('cedula', $cedula)->first();
            $email = Email::create([
                'email' => $request,
            ]);
            $persona->Email()->save($email);
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




        //relaciones
        public function User()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }
        public function Sexo()
        {
            return $this->belongsTo(Sexo::class, 'sexo_id', 'id');
        }
        public function Trabajo()
        {
            return $this->belongsTo(Trabajo::class, 'trabajo_id', 'id');
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
        public function Participante()
        {
        return $this->hasOne(Participante::class, 'persona_Cedula', 'cedula');
        }
        public function Pariente()
    {
        return $this->hasOne(Pariente::class, 'persona_cedula', 'cedula');
    }

}
