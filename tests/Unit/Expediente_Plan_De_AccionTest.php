<?php

namespace Tests\Unit;
use App\Models\Expediente_Plan_De_Accion;
use PHPUnit\Framework\TestCase;

class Expediente_Plan_De_AccionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_UnExpedientePaiTieneUnNumeroDeSolicitud()
    {
        $expediente_plan_de_accion = new Expediente_Plan_De_Accion(['solicitud_Numero' => '10005']);
        $this->assertEquals("10005" , $expediente_plan_de_accion->solicitud_Numero);
    }
    public function test_UnExpedientePaiTieneUnaFecha()
    {
        $expediente_plan_de_accion = new Expediente_Plan_De_Accion(['fecha' => '07/07/2022']);
        $this->assertEquals("07/07/2022" , $expediente_plan_de_accion->fecha);
    }
}
