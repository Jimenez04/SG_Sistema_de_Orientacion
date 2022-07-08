<?php

namespace Tests\Feature\Models;

use App\Models\Archivos;
use App\Models\Revision_Solicitud;
use App\Models\SolicitudDeAdecuacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SolicitudAdecuacionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
   public function test_UnaSolicitudAdecuacionAgregaArchivos()
    {
        SolicitudDeAdecuacion::factory()->create(['id' => '1'])->save();
        Archivos::factory()->create(['id' => '1'])->save();
        Archivos::factory()->create(['id' => '2'])->save();

        $solicitud = SolicitudDeAdecuacion::find('1');

        $solicitud->addArhivos(Archivos::find(1));
        $solicitud->addArhivos(Archivos::find(2));
        
        $this->assertEquals('2', $solicitud->countArchivos());
    }   
    
    public function test_UnaSolicitudAdecuacionAgregaSuRevision()
    {
        SolicitudDeAdecuacion::factory()->create(['id' => '1'])->save();
        Revision_Solicitud::factory()->create(['id' => '1'])->save();

       $solicitud = SolicitudDeAdecuacion::find('1');

        $solicitud->addRevisionSolicitud(Revision_Solicitud::find(1));
        
        $this->assertEquals($solicitud->id, $solicitud->getRevisionSolicitudId());
    }   
}
