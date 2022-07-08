<?php
namespace Tests\Unit;
use App\Models\Estudiante;
use PHPUnit\Framework\TestCase;

class EstudianteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_UnEstudianteTieneCarnet()
    {
        $estudiante = new Estudiante(['carnet' => '771067']);
        $this->assertEquals("771067" , $estudiante->carnet);
    }
    public function test_UnEstudianteTieneUnAnoDeIngreso()
    {
        $estudiante = new Estudiante(['ano_Ingreso' => '2020']);
        $this->assertEquals("2020" , $estudiante->ano_Ingreso);
    }
    public function test_UnEstudianteTieneProfesorConsejero()
    {
        $estudiante = new Estudiante(['profesor_Consejero' => 'Rafael Martinez']);
        $this->assertEquals("Rafael Martinez" , $estudiante->profesor_Consejero);
    }
}
