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