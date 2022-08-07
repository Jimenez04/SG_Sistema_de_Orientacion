<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
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

        public function addPersonalEmail($request){
            try{
                if($request['cedula'] == Auth::user()->Persona->cedula){
                    if(Auth::user()->Persona->Email->where('email', $request['email'])->first() == null){
                        if($this->addEmail($request['cedula'],$request['email'])){
                                    return response()->json([
                                        "status" => true,
                                        "Message" => "El email fue agregado correctamente al usuario",
                                    ],200);
                            }else{
                                return response()->json([
                                "status" => false,
                                "error" => "Ocurrio un problema al agregar el email",
                            ],500);
                        }
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "Este email ya esta asociado a su cuenta",
                        ],409);
                    }
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para editar esta persona",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function addEmail_Admin($request){ //El admin le agrega EMAIL a cualquier persona
            try{
                if("Administrador" == Auth::user()->role->role){
                    if(Persona::find($request['cedula'])->Email->where('email', $request['email'])->first() == null){
                        if($this->addEmail($request['cedula'],$request['email'])){
                                    return response()->json([
                                        "status" => true,
                                        "Message" => "El email fue agregado correctamente a la persona",
                                    ],200);
                            }else{
                                return response()->json([
                                "status" => false,
                                "error" => "Ocurrio un problema al agregar el email",
                            ],500);
                        }
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "Este email ya esta asociado a la persona",
                        ],409);
                    }
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para editar esta persona",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        
        public function getEmails_Personal(){ 
            try{
                if("Estudiante" == Auth::user()->role->role){
                    $emails = Persona::find(Auth::user()->Persona->cedula)->Email;    
                    if($emails != null){
                        return response()->json([
                            "success" => true,
                            "message" => "Lista de emails",
                            "data" => $emails
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "No tiene ningun email asociado a su cuenta",
                        ],409);
                    }

                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos de esta persona",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function getEmail_Personal($id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }

                if("Estudiante" == Auth::user()->role->role){
                    $email = Auth::user()->Persona->Email->find($id);    
                    if($email != null){
                        return response()->json([
                            "success" => true,
                            "message" => "Email",
                            "data" => $email
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "El email no existe en su perfil",
                        ],404);
                    }

                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function getEmails_Admin($cedula){ 
            try{
                $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                $data = $this->validate_cedula_DB($cedula, true);
                if(!$data['status']){
                    return response()->json($data,400);
                }
                if("Administrador" == Auth::user()->role->role){
                    $emails = Persona::find($cedula)->Email;    
                    if($emails != null){
                        return response()->json([
                            "success" => true,
                            "message" => "Lista de emails",
                            "data" => $emails
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "La cuenta no tiene ningun email asociado",
                        ],409);
                    }
                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos de esta persona",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function getEmail_Admin($cedula, $id){ 
            try{
                $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                $data = $this->validate_cedula_DB($cedula, true);
                if(!$data['status']){
                    return response()->json($data,400);
                }
               
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }

                if("Administrador" == Auth::user()->role->role){
                    $email = Persona::find($cedula)->Email->find($id);    
                    if($email != null){
                        return response()->json([
                            "success" => true,
                            "message" => "Email",
                            "data" => $email
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "El email no existe en este perfil",
                        ],404);
                    }

                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function updateEmail_Personal($request){ 
            try{
                $isnumeric = json_decode($this->verificarID($request['id'])->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }

                if("Estudiante" == Auth::user()->role->role){
                    $email = Auth::user()->Persona->Email->find($request['id']);    
                    if($email != null){
                        if($email->email == Auth::user()->email){
                            return response()->json([
                                "success" => false,
                                "message" => "Imposible actualizar el email principal",
                                ],400);
                        }
                        Auth::user()->Persona->Email->find($request['id'])->update($request);
                        return response()->json([
                            "success" => true,
                            "message" => "Email actualizado correctamente",
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "El email no existe en su perfil",
                        ],404);
                    }

                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function updateEmail_Admin($request){ 
            try{
                $isnumeric = json_decode($this->verificarID($request['id'])->getContent());
                    if(!$isnumeric->status){
                        return response()->json($isnumeric,400);
                    }

                if("Administrador" == Auth::user()->role->role){
                    $email = Persona::find($request['cedula'])->Email->find($request['id']);    
                    if($email != null){
                        if($email->email == Persona::find($request['cedula'])->Email->first()->email){
                            return response()->json([
                                "success" => false,
                                "message" => "Imposible actualizar el email principal de esta persona",
                            ],400);
                        }
                        Persona::find($request['cedula'])->Email->find($request['id'])->update($request);
                        return response()->json([
                            "success" => true,
                            "message" => "Email actualizado correctamente",
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "El email no existe en su perfil",
                        ],404);
                    }

                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function deleteEmail_Personal($id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }

                if("Estudiante" == Auth::user()->role->role){
                    $email = Auth::user()->Persona->Email->find($id);    
                    if($email != null){
                        if($email->email == Auth::user()->email){
                            return response()->json([
                                "success" => false,
                                "message" => "Imposible eliminar el email principal",
                                ],400);
                        }
                        Auth::user()->Persona->Email->find($id)->delete();
                        return response()->json([
                            "success" => true,
                            "message" => "Email eliminado correctamente",
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "El email no existe en su perfil",
                        ],404);
                    }

                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function deleteEmail_Admin($cedula, $id){ 
            try{
                $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                $data = $this->validate_cedula_DB($cedula, true);
                    if(!$data['status']){
                        return response()->json($data,400);
                    }
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                    if(!$isnumeric->status){
                        return response()->json($isnumeric,400);
                    }

                if("Administrador" == Auth::user()->role->role){
                    $email = Persona::find($cedula)->Email->find($id);    
                    if($email != null){
                        if($email->email == Persona::find($cedula)->Email->first()->email){
                            return response()->json([
                                "success" => false,
                                "message" => "Imposible eliminar el email principal de esta persona",
                            ],400);
                        }
                        Persona::find($cedula)->Email->find($id)->delete();
                        return response()->json([
                            "success" => true,
                            "message" => "Email eliminado correctamente",
                            ],200);
                    }else{
                        return response()->json([
                            "status" => false,
                            "error" => "El email no existe en su perfil",
                        ],404);
                    }

                }else{
                    return response()->json([
                        "status" => false,
                        "error" => "No tiene permisos para acceder a los datos",
                    ],403);
                }
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

        public function verificarID($id){
            if(!is_numeric($id)){
                return response()->json([
                    "status" => false,
                    "error" => "El id debe ser un número",
                ],400);
            }else{return response()->json([
                "status" => true,
            ],200);}
        }

        private function validate_cedula_DB($cedula, $json = false){
            $data = Persona::where('cedula', $cedula)->exists();
                if(!$json){
                    return $data;
                }else{
                    if($data){
                        return [
                            "status" => $data,
                        ];
                    }
                        return [
                            "status" => $data,
                            "error" => "La persona no existe en la base de datos",
                        ];
                }
                
               
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
            return $persona->Email()->save($email);
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
