<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\emailupdate_admin_request;
use App\Http\Requests\emailupdate_request;
use App\Http\Requests\Find_ID_Request;
use App\Http\Requests\newnum__request;
use App\Http\Requests\personalEmailRequest;
use App\Http\Requests\updateNumber__request;
use App\Models\Persona;
use Illuminate\Http\Request;


use Validator;

class PersonaController extends Controller
{
        public function Persona()
        {
            return $persona = new Persona();
        }
        public function index()
        {
            return $this->Persona()->allPersons();
        }

                  /**
        * @OA\Post(
        * path="/api/personas",
        * operationId="Crear Persona",
        * tags={"Persona"},
        * security={
        *  {"api_key": {}},
        *   },
        * summary="Registro de personas",
        * description="Acá se registran las personas familiares de usuarios",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"cedula", "nombre1", "apellido1", "apellido2", "fecha_Nacimiento", "sexo_id"},
        *               @OA\Property(property="cedula", type="text"),
        *               @OA\Property(property="nombre1", type="text"),
        *               @OA\Property(property="nombre2", type="text"),
        *               @OA\Property(property="apellido1", type="text"),
        *               @OA\Property(property="apellido2", type="text"),
        *               @OA\Property(property="fecha_Nacimiento", type="date", format="date"),
        *               @OA\Property(property="sexo_id", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Register Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Register Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
        public function Post(CreatePersonRequest $request)
        {
            return $this->Persona()->newPerson($request->validated());
        } 
        //email
        public function addEmailpersonal(personalEmailRequest $request)
        {
            return $this->Persona()->addPersonalEmail('Estudiante', $request->validated());
        } 
        public function addEmailAdmin(personalEmailRequest $request)
        {
            return $this->Persona()->addPersonalEmail('Administrador', $request->validated());
        } 
        public function getEmails_Personal()
        {
            return $this->Persona()->getEmails_Personal('Estudiante', '');
        } 
        public function getEmails_Admin($cedula)
        {
            return $this->Persona()->getEmails_Personal('Administrador',$cedula);
        } 
        public function getEmail_Personal($id)
        {
            return $this->Persona()->getEmail_Personal('Estudiante', '', $id);
        } 
        public function getEmail_Admin($cedula, $id)
        {
            return $this->Persona()->getEmail_Personal('Administrador' ,$cedula , $id);
        } 
        public function updateEmail_Personal(emailupdate_request $request)
        {
            return $this->Persona()->updateEmail_Personal('Estudiante', $request->validated());
        }
        public function updateEmail_Admin(emailupdate_admin_request $request)
        {
            return $this->Persona()->updateEmail_Personal('Administrador', $request->validated());
        } 
        public function deleteEmail_Personal($id)
        {
            return $this->Persona()->deleteEmail_Personal('Estudiante','',$id);
        } 
        public function deleteEmail_Admin($cedula, $id)
        {
            return $this->Persona()->deleteEmail_Personal('Administrador', $cedula, $id);
        } 
    	//end email

        //Contacto Telefono
        public function add_NumberPersonal(newnum__request $request)
        {
            return $this->Persona()->addPersonalNumber('Estudiante' ,$request->validated());
        }
        public function add_NumberAdmin(newnum__request $request)
        {
            return $this->Persona()->addPersonalNumber('Administrador' ,$request->validated());
        } 
        public function getNumbers_Personal()
        {
            return $this->Persona()->getnumbers_Personal('Estudiante');
        } 
        public function getNumbers_Admin($cedula)
        {
            return $this->Persona()->getnumbers_Personal('Administrador',$cedula);
        } 
        public function getnumber_Personal($id)
        {
            return $this->Persona()->getnumber_Personal('Estudiante','',$id);
        } 
        public function get_number_Admin($cedula, $id)
        {
            return $this->Persona()->getnumber_Personal('Administrador',$cedula, $id);
        } 
        public function update_Number_Personal(updateNumber__request $request)
        {
            return $this->Persona()->updatenumber_Personal('Estudiante',$request->validated());
        }
        public function update_Number_Admin(updateNumber__request $request)
        {
            return $this->Persona()->updatenumber_Personal('Administrador', $request->validated());
        } 
        public function delete_Number_Personal($id)
        { 
            return $this->Persona()->deletenumber_Personal('Estudiante','', $id);
        } 
        public function delete_Number_Admin($cedula, $id)
        {
            return $this->Persona()->deletenumber_Admin('Administrador', $cedula, $id);
        } 

        //End Contacto Telefono


/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function show($id)
    {

    }
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function update()
    {

    }
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
        public function destroy()
        {

        }
}