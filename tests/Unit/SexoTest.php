<?php

namespace Tests\Unit;

use App\Models\Sexo;
use PHPUnit\Framework\TestCase;

class SexoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_agregarSexo()
    {
        $sexo = new Sexo(['id' => '1', 'nombre' => 'No Binario']);
        $this->assertEquals("No Binario" , $sexo->nombre);
    }
}
