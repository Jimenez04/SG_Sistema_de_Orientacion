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
        protected $primaryKey =  'cedula'; 

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

        public function GetPerson($cedula){
            try {
                $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                $data = $this->validate_cedula_DB($cedula, true);
                    if(!$data['status']){
                        return response()->json($data,400);
                    }
                    if($this->validate_cedula_DB($cedula)){
                        $person = Persona::find($cedula);
                        return response()->json([
                        "success" => true,
                        "message" => "Persona",
                        "data" => $person
                        ],200);
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "La persona no existe", 
                    ],400);
            }
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
                $cedula = (trim(stripslashes(htmlspecialchars($request['cedula'])))); 
                if($this->validate_cedula_DB($cedula)){
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

                    $estudiante = new Estudiante();
                    $response = $estudiante->add($request);
                    $response = json_decode($response->getContent());

                    if(!$response->status){
                        $persona->delete();
                        return response()->json($response);
                    }else if($response->status == 3 || $response->status){
                            $estudiante = Estudiante::find($request['carnet']);
                                $persona->associateStudent($cedula, $estudiante);
                    }         
                    
                    $persona->addEmail($cedula, $request['email']); //En caso que sea un nuevo usuario
                    $persona->addSex($request['sexo_id'], $cedula);

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

        public function update_personal_information($user, $request){
                try{
                    $code = 403;
                    $data = $this->validate_cedula_DB($request['cedula'], true);
                        if(!$data['status']){
                            return response()->json($data,400);
                        }
                            $persona = Persona::find($request['cedula']);
                            $validated = $user == 'Estudiante' ?  $this->user_validated($request) : $this->admin_validatedRol();
                                if($user == 'Estudiante' || $user == 'Administrador'){
                                    if($validated['status']){ 
                                        $persona->update($request);
                                        $code = 200;
                                        $validated = ['status' => true, 'message' => 'Actualizado correctamente'];
                                    }
                                }
                        return response()->json($validated,$code);
                }catch (\Throwable $th) {
                    return response()->json([
                        "status" => false,
                        "error" => $th->getMessage(),
                        ],500);
                }
        }

        //sex
        public function getNameSex()
        {
            return $this->Sexo()->get()->first()->nombre;
        }

        public function addSex($id_Sexo, $cedula){
            $persona = Persona::where('cedula', $cedula)->first();
            $sexo = Sexo::find($id_Sexo);
            return $sexo->addPersonSex($persona);
         }

        public function updateSex($id_Sexo){
           $this->update(['sexo_id' => $id_Sexo]);
        }

        //Work
        public function addPersonal_Job($user,$request){
            try{
                $trabajo =  new Trabajo();
                $validated = $user == 'Estudiante' ?  $this->user_validated($request) : $this->admin_validatedRol();
                if($user == 'Estudiante'){
                    if($validated['status']){ 
                        return  $trabajo->add(Auth::user()->Persona, $request);
                    }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                            $data = $this->validate_cedula_DB($request['cedula'], true);
                                if(!$data['status']){
                                    return response()->json($data,400);
                                }
                        return  $trabajo->add(Persona::find($request['cedula']), $request);
                    }
                }
                 
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getAllJobs_Personal($user, $cedula = null){ 
            try{
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $trabajo =  new Trabajo();
                if($user == 'Estudiante'){
                    if($validated['status']){
                        return $trabajo->get_all(Persona::find(Auth::user()->Persona->cedula));    
                    }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                        return  $trabajo->get_all(Persona::find($cedula));
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getJob_Personal($user, $cedula = null, $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $trabajo =  new Trabajo();
                    if($user == 'Estudiante'){
                        if($validated['status']){
                            return $trabajo->get(Persona::find(Auth::user()->Persona->cedula), $id);    
                        }
                    }else if($user == 'Administrador'){ 
                        if($validated['status']){ 
                            $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                            $data = $this->validate_cedula_DB($cedula, true);
                                if(!$data['status']){
                                    return response()->json($data,400);
                                }
                            return $trabajo->get(Persona::find($cedula), $id);    
                        }
                    }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function updateJob_Personal($user, $request){ 
            try{
                $isnumeric = json_decode($this->verificarID($request['id'])->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $trabajo =  new Trabajo();
                    if($user == 'Estudiante'){
                        if($validated['status']){
                            return $trabajo->update_e(Auth::user()->Persona, $request);
                        }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($request['cedula'])))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                        if(!$data['status']){
                            return response()->json($data,400);
                        }
                        return $trabajo->update_e(Persona::find($cedula), $request);    
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function deleteJob_Personal($user, $cedula = null, $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $trabajo =  new Trabajo();
                    if($user == 'Estudiante'){
                            if($validated['status']){
                                return $trabajo->delete_e(Auth::user()->Persona, $id);
                            }
                    }else if($user == 'Administrador'){ 
                        if($validated['status']){ 
                            $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                            $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                            return $trabajo->delete_e(Persona::find($cedula), $id); 
                        }
                    }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        //endWork

        //sickness
        public function addPersonal_Sickness($user,$request){
            try{
                $enfermedad =  new Enfermedad();
                $validated = $user == 'Estudiante' ?  $this->user_validated($request) : $this->admin_validatedRol();
                if($user == 'Estudiante'){
                    if($validated['status']){ 
                        return  $enfermedad->add(Auth::user()->Persona, $request);
                    }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                            $data = $this->validate_cedula_DB($request['cedula'], true);
                                if(!$data['status']){
                                    return response()->json($data,400);
                                }
                        return  $enfermedad->add(Persona::find($request['cedula']), $request);
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getAllSickness_Personal($user, $cedula = null){ 
            try{
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $enfermedad =  new Enfermedad();
                if($user == 'Estudiante'){
                    if($validated['status']){
                        return $enfermedad->get_all(Persona::find(Auth::user()->Persona->cedula));    
                    }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                        return  $enfermedad->get_all(Persona::find($cedula));
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getSickness_Personal($user, $cedula = null, $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $enfermedad =  new Enfermedad();
                    if($user == 'Estudiante'){
                        if($validated['status']){
                            return $enfermedad->get(Persona::find(Auth::user()->Persona->cedula), $id);    
                        }
                    }else if($user == 'Administrador'){ 
                        if($validated['status']){ 
                            $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                            $data = $this->validate_cedula_DB($cedula, true);
                                if(!$data['status']){
                                    return response()->json($data,400);
                                }
                            return $enfermedad->get(Persona::find($cedula), $id);    
                        }
                    }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function updateSickness_Personal($user, $request){ 
            try{
                $isnumeric = json_decode($this->verificarID($request['id'])->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $enfermedad =  new Enfermedad();
                    if($user == 'Estudiante'){
                        if($validated['status']){
                            return $enfermedad->update_e(Auth::user()->Persona, $request);
                        }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($request['cedula'])))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                        if(!$data['status']){
                            return response()->json($data,400);
                        }
                        return $enfermedad->update_e(Persona::find($cedula), $request);    
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function deleteSickness_Personal($user, $cedula = null, $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $enfermedad =  new Enfermedad();
                    if($user == 'Estudiante'){
                            if($validated['status']){
                                return $enfermedad->delete_e(Auth::user()->Persona, $id);
                            }
                    }else if($user == 'Administrador'){ 
                        if($validated['status']){ 
                            $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                            $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                            return $enfermedad->delete_e(Persona::find($cedula), $id); 
                        }
                    }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function addSickness($request){
            $enfermedad = new Enfermedad($request);
            return $this->Enfermedad()->save($enfermedad);
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
        public function addPersonalNumber($user,$request){
            try{
                $contacto =  new Contacto();
                $validated = $user == 'Estudiante' ?  $this->user_validated($request) : $this->admin_validatedRol();
                if($user == 'Estudiante'){
                    if($validated['status']){ 
                        return  $contacto->add(Auth::user()->Persona, $request);
                    }
                }else if($user == 'Administrador'){ //El admin le agrega números a cualquier persona
                    if($validated['status']){ 
                            $data = $this->validate_cedula_DB($request['cedula'], true);
                                if(!$data['status']){
                                    return response()->json($data,400);
                                }
                        return  $contacto->add(Persona::find($request['cedula']), $request);
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getnumbers_Personal($user, $cedula = null){ 
            try{
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $contacto =  new Contacto();
                if($user == 'Estudiante'){
                    if($validated['status']){
                        return $contacto->get_all(Persona::find(Auth::user()->Persona->cedula));    
                    }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                        return  $contacto->get_all(Persona::find($cedula));
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getnumber_Personal($user, $cedula = null, $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $contacto =  new Contacto();
                    if($user == 'Estudiante'){
                        if($validated['status']){
                            return $contacto->get(Persona::find(Auth::user()->Persona->cedula), $id);    
                        }
                    }else if($user == 'Administrador'){ 
                        if($validated['status']){ 
                            $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                            $data = $this->validate_cedula_DB($cedula, true);
                                if(!$data['status']){
                                    return response()->json($data,400);
                                }
                            return $contacto->get(Persona::find($cedula), $id);    
                        }
                    }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function updatenumber_Personal($user, $request){ 
            try{
                $isnumeric = json_decode($this->verificarID($request['id'])->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $contacto =  new Contacto();
                    if($user == 'Estudiante'){
                        if($validated['status']){
                            return $contacto->update_e(Auth::user()->Persona, $request);
                        }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($request['cedula'])))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                        if(!$data['status']){
                            return response()->json($data,400);
                        }
                        return $contacto->update_e(Persona::find($cedula), $request);    
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function deletenumber_Personal($user, $cedula = null, $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $contacto =  new Contacto();
                    if($user == 'Estudiante'){
                            if($validated['status']){
                                return $contacto->delete_e(Auth::user()->Persona, $id);
                            }
                    }else if($user == 'Administrador'){ 
                        if($validated['status']){ 
                            $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                            $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                            return $contacto->delete_e(Persona::find($cedula), $id); 
                        }
                    }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

         public function addContact($cedula, $numero){
            $persona = Persona::where('cedula', $cedula)->first();
            $contacto = Contacto::create([
                'numero' => $numero,
            ]);
            return $persona->Contacto()->save($contacto);
        }
        public function countContact()
        {
            return $this->Contacto()->count();
        }
        //endcontact

         //email
         public function addPersonalEmail($user, $request){
            try{
                $email =  new Email();
                $validated = $user == 'Estudiante' ?  $this->user_validated($request) : $this->admin_validatedRol();
                if($user == 'Estudiante'){
                    if($validated['status']){ 
                        return  $email->add(Auth::user()->Persona, $request);
                    }
                }else if($user == 'Administrador'){ //El admin le agrega email a cualquier persona
                    if($validated['status']){ 
                            $data = $this->validate_cedula_DB($request['cedula'], true);
                                if(!$data['status']){
                                    return response()->json($data,400);
                                }
                        return  $email->add(Persona::find($request['cedula']), $request);
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getEmails_Personal($user, $cedula = null){ 
            try{
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $email =  new Email();
                if($user == 'Estudiante'){
                        if($validated['status']){
                            return $email->get_all(Persona::find(Auth::user()->Persona->cedula));    
                        }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                        return  $email->get_all(Persona::find($cedula));
                    }
                }
                    return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function getEmail_Personal($user, $cedula = null,  $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $email =  new Email();
                if($user == 'Estudiante'){
                        if($validated['status']){
                            return $email->get(Persona::find(Auth::user()->Persona->cedula), $id);    
                        }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                        return $email->get(Persona::find($cedula), $id);    
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function updateEmail_Personal($user, $request){ 
            try{
                $isnumeric = json_decode($this->verificarID($request['id'])->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $email =  new Email();
                if($user == 'Estudiante'){
                        if($validated['status']){
                            return $email->update_e(Auth::user()->Persona, $request);
                        }
                }else if($user == 'Administrador'){ 
                    if($validated['status']){ 
                        $cedula = (trim(stripslashes(htmlspecialchars($request['cedula'])))); 
                        $data = $this->validate_cedula_DB($cedula, true);
                        if(!$data['status']){
                            return response()->json($data,400);
                        }
                        return $email->update_e(Persona::find($cedula), $request);    
                    }
                }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
        public function deleteEmail_Personal($user, $cedula = null, $id){ 
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated = $user == 'Estudiante' ?  $this->user_validatedRol() : $this->admin_validatedRol();
                $email =  new Email();
                    if($user == 'Estudiante'){
                        if($validated['status']){
                            return $email->delete_e(Auth::user()->Persona, $id);
                        }
                    }else if($user == 'Administrador'){ 
                        if($validated['status']){ 
                            $cedula = (trim(stripslashes(htmlspecialchars($cedula)))); 
                            $data = $this->validate_cedula_DB($cedula, true);
                            if(!$data['status']){
                                return response()->json($data,400);
                            }
                            return $email->delete_e(Persona::find($cedula), $id); 
                        }
                    }
                return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }
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

        //Student
        public function associateStudent($cedula, $estudiante){
            $persona = Persona::where('cedula', $cedula)->first();
            return $persona->Estudiante()->save($estudiante);
        }
        public function getStudentCarnet()
        {
            return $this->Estudiante()->get()->first()->attributes['carnet'];
        } 
        //endStudent

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
//validaciones
    private function belong_to_user($cedula){
        $persona = Persona::find($cedula);
        return $persona->User()->exists();
    }
    public function   belong_to_student($cedula){
        $persona = Persona::find($cedula);
        return $persona->Estudiante()->exists();
    }
    public function   find_student($cedula){
        $persona = Persona::find($cedula);
        return $persona->Estudiante;
    }
    public function user_validated($request){
        if($request['cedula'] == Auth::user()->Persona->cedula){ 
            return  ['status'=>true];
        }else{
            return [
                "status" => false,
                "error" => "No tiene permisos para editar esta persona",
                    ];
        }
    }
     public function admin_validatedRol(){
        if("Administrador" == Auth::user()->role->role){
            return  ['status'=>true];
        }else{
            return [
                "status" => false,
                "error" => "No tiene permisos para gestionar esta persona",
                    ];
        }
    }
    public function user_validatedRol(){
        if("Estudiante" == Auth::user()->role->role){
            return  ['status'=>true];
        }else{
            return [
                "status" => false,
                "error" => "No tiene permisos para gestionar esta persona",
                    ];
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
    public function validate_cedula_DB($cedula, $json = false){
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
}
