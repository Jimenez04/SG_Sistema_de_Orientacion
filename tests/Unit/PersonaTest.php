<?php

namespace Tests\Unit;

use App\Models\Persona;
use PHPUnit\Framework\TestCase;

class PersonaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_UnaPersonaTieneCedula()
    {
        $persona = new Persona(['cedula' => '11111111']);
        $this->assertEquals("11111111" , $persona->cedula);
    }
    public function test_UnaPersonaTienePrimerNombre()
    {
        $persona = new Persona(['nombre1' => 'Pepillo']);
        $this->assertEquals("Pepillo" , $persona->nombre1);
    }

    public function test_UnaPersonaTieneSegundoNombre()
    {
        $persona = new Persona(['nombre2' => 'El Grillo']);
        $this->assertEquals("El Grillo" , $persona->nombre2);
    }

    public function test_UnaPersonaTienePrimerApellido()
    {
        $persona = new Persona(['apellido1' => 'Del Socorro']);
        $this->assertEquals("Del Socorro" , $persona->apellido1);
    }
    public function test_UnaPersonaTieneSegundoApellido()
    {
        $persona = new Persona(['apellido2' => 'Del Carmen']);
        $this->assertEquals("Del Carmen" , $persona->apellido2);
    }
    
}
