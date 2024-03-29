<?php

namespace Tests\Feature\Models;

use App\Models\Administrador;
use App\Models\Contacto;
use App\Models\Email;
use App\Models\Enfermedad;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Sexo;
use App\Models\Trabajo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_UnaPersonaSeRelacionaConUnSexo()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        Sexo::factory()->create(['id' => '1', 'nombre' => 'Masculino'])->save();
        
        $persona = Persona::find('504250352');
        $sexo =  Sexo::find('1');
        $sexo->addPersonSex($persona);

        $this->assertEquals('Masculino', $persona->getNameSex());
    }

    public function test_UnaPersonaActualizaSuSexo()
    {
        Persona::factory()->create(['cedula' => '504250352']);
        Sexo::factory()->create(['id' => '1', 'nombre' => 'Masculino']);
        Sexo::factory()->create(['id' => '3', 'nombre' => 'NoBinario']);
        
        $persona = Persona::find('504250352');
        $sexo =  Sexo::find('1');
        $sexo->addPersonSex($persona);

        $this->assertEquals('Masculino', $persona->getNameSex());

        $sexo2 =  Sexo::find('3');
        $sexo2->updatePersonSex($persona,$sexo2->id);

        $this->assertEquals('NoBinario', $persona->getNameSex());
    } 

    public function test_UnaPersonaAgreganUnUsuario()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        User::factory()->create(['id' => '1'])->save();
        
        $persona = Persona::find('504250352');
        $user =  user::find('1');
        $user->addperson($persona);

        $this->assertEquals($user->id, $persona->user_id);
    }

    public function test_UnaPersonaAgreganUnTrabajo()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        Trabajo::factory()->create(['id' => '1'])->save();
        
        $persona = Persona::find('504250352');
        $trabajo =  Trabajo::find('1');
        $trabajo->addperson($persona);

        $this->assertEquals($trabajo->id, $persona->trabajo_id);
    }

    public function test_UnaPersonaAgreganUnaOMasEnfermedades()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        $enfermedad1 = Enfermedad::factory()->create();
        $enfermedad2 = Enfermedad::factory()->create();
        
        $persona = Persona::find('504250352');
        $persona->addsickness($enfermedad1);
        $persona->addsickness($enfermedad2);

        $this->assertEquals(2, $persona->countSickness());
    }

     public function test_UnaPersonaEliminaUnaOMasEnfermedades()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        $enfermedad1 = Enfermedad::factory()->create();
        $enfermedad2 = Enfermedad::factory()->create();
        
        $persona = Persona::find('504250352');
        $persona->addsickness($enfermedad1);
        $persona->addsickness($enfermedad2);

        $this->assertEquals(2, $persona->countSickness());
        $persona->deletesickness($enfermedad1);

        $this->assertEquals(1, $persona->countSickness());
    } 

    public function test_UnaPersonaAgreganUnaOMasContactos()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        $contacto1 = Contacto::factory()->create();
        $contacto2 = Contacto::factory()->create();
        
        $persona = Persona::find('504250352');
        $persona->addContact($contacto1);
        $persona->addContact($contacto2);

        $this->assertEquals(2, $persona->countContact());
    }

    public function test_UnaPersonaAgreganUnaOMasEmail()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        
        $persona = Persona::find('504250352');
        $persona->addEmail('504250352','jose.040199@gmail.com');
        $persona->addEmail('504250352', 'jose.040199@hotmail.com');

        $this->assertEquals(2, $persona->countEmail());
    }

    public function test_UnaPersonaPuedeSerUnEstudiante()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        Estudiante::factory()->create(['carnet' => 'B84135'])->save();

        $persona = Persona::find('504250352');
        $persona->associateStudent(Estudiante::find('B84135'));

        $this->assertEquals('B84135', $persona->getStudentCarnet());
    }

    public function test_UnaPersonaPuedeSerUnAdministrador()
    {
        Persona::factory()->create(['cedula' => '504250352'])->save();
        Administrador::factory()->create(['id' => '1'])->save();

        $persona = Persona::find('504250352');
        $persona->associateAdmin(Administrador::find(1));

        $this->assertEquals($persona->cedula, $persona->getAdminCedula());
    }
}
