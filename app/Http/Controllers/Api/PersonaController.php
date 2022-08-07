<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\emailupdate_admin_request;
use App\Http\Requests\emailupdate_request;
use App\Http\Requests\Find_ID_Request;
use App\Http\Requests\personalEmailRequest;
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
        *               required={"cedula", "nombre1", "nombre2", "apellido1", "apellido2", "fecha_Nacimiento", "sexo_id"},
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
            return $this->Persona()->addPersonalEmail($request->validated());
        } 
        
        public function addEmail_Family_Group(CreatePersonRequest $request) //aun no se puede
        {
            //return $this->Persona()->newPerson($request->validated());
        } 

        public function addEmailAdmin(personalEmailRequest $request)
        {
            return $this->Persona()->addEmail_Admin($request->validated());
        } 
        
        public function getEmails_Personal()
        {
            return $this->Persona()->getEmails_Personal();
        } 
        
        public function getEmail_Personal($id)
        {
            return $this->Persona()->getEmail_Personal($id);
        } 
        //
        public function getEmails_Admin($cedula)
        {
            return $this->Persona()->getEmails_Admin($cedula);
        } 
        public function getEmail_Admin($cedula, $id)
        {
            return $this->Persona()->getEmail_Admin($cedula, $id);
        } 

        public function updateEmail_Personal(emailupdate_request $request)
        {
            return $this->Persona()->updateEmail_Personal($request->validated());
        } 

        public function updateEmail_Admin(emailupdate_admin_request $request)
        {
            return $this->Persona()->updateEmail_Admin($request->validated());
        } 
        
        public function deleteEmail_Personal($id)
        {
            return $this->Persona()->deleteEmail_Personal($id);
        } 
        public function deleteEmail_Admin($cedula, $id)
        {
            return $this->Persona()->deleteEmail_Admin($cedula, $id);
        } 

    	//end email

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