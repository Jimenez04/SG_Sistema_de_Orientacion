<?php

namespace Tests\Unit;
    use App\Models\CursoUCR;
use PHPUnit\Framework\TestCase;

class Curso_UCRTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_UnCursoTieneSiglas()
    {
        $curso_u_c_r_ = new CursoUCR(['id' => '3100']);
        $this->assertEquals("3100" , $curso_u_c_r_->id);
    }
    public function test_UnCursoTieneNombre()
    {
        $curso_u_c_r_ = new CursoUCR(['nombre' => 'Calculo']);
        $this->assertEquals("Calculo" , $curso_u_c_r_->nombre);
    }
    public function test_UnCursoTieneCreditos()
    {
        $curso_u_c_r_ = new CursoUCR(['creditos' => '3']);
        $this->assertEquals("3" , $curso_u_c_r_->creditos);
    }

    public function test_UnCursoTieneUnaCarreraAsociada()
    {
        $curso_u_c_r_ = new CursoUCR(['carrera_id' => 'Economia']);
        $this->assertEquals("Economia" , $curso_u_c_r_->carrera_id);
    }
}
