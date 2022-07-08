<?php

namespace Tests\Feature\Models;

use App\Models\Persona;
use App\Models\Estudiante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EstudianteTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_UnaPersonaPuedeSerUnEstudiante()
    {
        $this->assertTrue(true);
    }
}
