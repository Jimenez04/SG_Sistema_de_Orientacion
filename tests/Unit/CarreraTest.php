<?php

namespace Tests\Unit;
use App\Models\Carrera;
use PHPUnit\Framework\TestCase;

class CarreraTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_UnaCarreraTieneEstudiantes()
    {
        $carrera = new Carrera(['estudiante_carnet' => 'Leonela']);
        $this->assertEquals("Leonela" , $carrera->estudiante_carnet);

        $carrera = new Carrera(['estudiante_carnet' => 'Kryssia']);
        $this->assertEquals("Kryssia" , $carrera->estudiante_carnet);

        $carrera = new Carrera(['estudiante_carnet' => 'Jose']);
        $this->assertEquals("Jose" , $carrera->estudiante_carnet);
    }
    public function test_UnaCarreraTieneUnEstado()
    {
        $carrera = new Carrera(['estado' => 'Finalizado']);
        $this->assertEquals("Finalizado" , $carrera->estado);
    }
    public function test_CarreraTieneUnId()
    {
        $carrera = new Carrera(['id' => '99999']);
        $this->assertEquals("99999" , $carrera->id);
    }

    public function test_CarreraTieneUnOrden()
    {
        $carrera = new Carrera(['orden' => '1']);
        $this->assertEquals("1" , $carrera->orden);
    }
}
