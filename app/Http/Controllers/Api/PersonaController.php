<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePersonRequest;
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