<?php

namespace Tests\Unit;
use App\Models\Administrador;
use App\Models\Persona;
use App\Models\Expediente_Plan_De_Accion;
use App\Models\Revision_Solicitud;
use PHPUnit\Framework\TestCase;

class AdministradorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_UnAdministradorTieneId()
    {
        $adminitrador = new Administrador(['id' => '504300743']);
        $this->assertEquals("504300743" , $adminitrador->id);
    }
    public function test_UnAdministradorTieneUnRol()
    {
        $adminitrador = new Administrador(['id_Rol' => 'Administrador']);
        $this->assertEquals("Administrador" , $adminitrador->id_Rol);
    }
    public function test_UnAdministradorTienePrimerNombre()
    {
        $persona = new Persona(['nombre1' => 'Isaac']);
        $this->assertEquals("Isaac" , $persona->nombre1);
    }
    public function test_UnAdministradorTieneUnExpedientePAI()
    {
        $expediente_plan_de_accion = new Expediente_Plan_De_Accion(['solicitud_Numero' => '12345']);
        $this->assertEquals("12345" , $expediente_plan_de_accion->solicitud_Numero);
    }
    public function test_UnAdministradorHaceRevisionDeSolicitudDeAdecuacion()
    {
        $revision_solicitud = new Revision_Solicitud(['solicitud_Numero' => '56789']);
        $this->assertEquals("56789" , $revision_solicitud->solicitud_Numero);
    }

}
