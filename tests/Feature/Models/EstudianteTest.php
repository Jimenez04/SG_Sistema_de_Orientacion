<?php

namespace Tests\Feature\Models;

use App\Models\Beca;
use App\Models\Carrera;
use App\Models\Carrera_UCR;
use App\Models\Persona;
use App\Models\Estudiante;
use App\Models\SolicitudDeAdecuacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EstudianteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
     public function test_UnEstudiantePuedeTenerUnaBeca()
    {
        Estudiante::factory()->create(['carnet' => 'B84135'])->save();
        $beca = Beca::factory()->create(['id' => '1']);

        $estudiante = Estudiante::find('B84135');
        $estudiante->addbeca(Beca::find('1')); 

        $this->assertEquals($beca->id, $estudiante->getBeca());
        
    } 
    
    public function test_UnEstudiantePuedeTenerUnaOMasCarreras()
    {
        Carrera::factory()->create(['id' => '1','carrera_id' => '1'])->save();
        Carrera::factory()->create(['id' => '2', 'carrera_id' => '2'])->save();
        Estudiante::factory()->create(['carnet' => 'B84135'])->save();

        $estudiante = Estudiante::find('B84135');
        $estudiante->addcarrera(Carrera::find(1));
        $estudiante->addcarrera(Carrera::find(2));

        $this->assertEquals(2, $estudiante->countCarrera());
    } 

     public function test_UnEstudianteAgregaUnaO_MasSolicitudDeAdecuacion()
    {
       SolicitudDeAdecuacion::factory()->create(['id' => '1'])->save();
        SolicitudDeAdecuacion::factory()->create(['id' => '3'])->save();
       $estudiante = Estudiante::factory()->create(['carnet' => 'B84135']);

       $estudiante->addSolicitudAdecuacion(SolicitudDeAdecuacion::find(1));
       $estudiante->addSolicitudAdecuacion(SolicitudDeAdecuacion::find(3));
       
       $this->assertEquals(2, $estudiante->countSolicitudAdecuacion());
    }  

} 
