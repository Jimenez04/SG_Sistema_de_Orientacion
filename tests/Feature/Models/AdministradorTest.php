<?php

namespace Tests\Feature\Models;

use App\Models\Administrador;
use App\Models\Persona;
use App\Models\Revision_Solicitud;
use App\Models\SolicitudDeAdecuacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdministradorTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function test_UnAdministradorAgregaUnaOMasRevisionesDeSolicitud()
    {
        Persona::factory()->create(['cedula' => '123456789']);
        $admin = Administrador::factory()->create(['id' => '1', 'persona_cedula' => '123456789']);

        SolicitudDeAdecuacion::factory()->create(['numero_solicitud' => '1'])->save();
        SolicitudDeAdecuacion::factory()->create(['numero_solicitud' => '2'])->save();

        Revision_Solicitud::factory()->create(['id' => '1', 'solicitud_Numero' => 1])->save();
        Revision_Solicitud::factory()->create(['id' => '2', 'solicitud_Numero' => 2])->save();

        $admin->addRevision(Revision_Solicitud::find(1));
        $admin->addRevision(Revision_Solicitud::find(2));
        
        $this->assertEquals('2', $admin->countRevision());
    }    
} 
