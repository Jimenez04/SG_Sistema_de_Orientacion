<?php

namespace Tests\Unit;
use App\Models\Carrera_UCR;
use PHPUnit\Framework\TestCase;

class Carrera_UCRTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_UnaCarreraUCRTieneId()
    {
        $carrera__u_c_r_ = new Carrera_UCR(['id' => '00000']);
        $this->assertEquals("00000" , $carrera__u_c_r_->id);
    }
    public function test_UnaCarreraUCRTieneNombre()
    {
        $carrera__u_c_r_ = new Carrera_UCR(['nombre' => 'Calculo']);
        $this->assertEquals("Calculo" , $carrera__u_c_r_->nombre);
    }
    public function test_UnaCarreraUCRTieneCoordinador()
    {
        $carrera__u_c_r_ = new Carrera_UCR(['coordinador' => 'Leonardito']);
        $this->assertEquals("Leonardito" , $carrera__u_c_r_->coordinador);
    }

    public function test_UnaCarreraUCRTieneCreditos()
    {
        $carrera__u_c_r_ = new Carrera_UCR(['creditos' => '4']);
        $this->assertEquals("4" , $carrera__u_c_r_->creditos);
    }
}
