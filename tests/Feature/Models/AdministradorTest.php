<?php

namespace Tests\Feature\Models;

use App\Models\Administrador;
use App\Models\Revision_Solicitud;
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
        $admin = Administrador::factory()->create(['id' => '1', 'persona_cedula' => '123456789']);
        Revision_Solicitud::factory()->create(['id' => '1'])->save();
        Revision_Solicitud::factory()->create(['id' => '2'])->save();

        $admin->addRevision(Revision_Solicitud::find(1));
        $admin->addRevision(Revision_Solicitud::find(2));
        
        $this->assertEquals('2', $admin->countRevision());
    }    
} 
