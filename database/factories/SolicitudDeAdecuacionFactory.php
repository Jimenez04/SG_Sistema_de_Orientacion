<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolicitudDeAdecuacion>
 */
class SolicitudDeAdecuacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'numero_solicitud' => $this->faker->numberBetween(1, 100),
            'razon_Solicitud' => $this->faker->sentence,
            'carrera_Empadronada'=> $this->faker->numberBetween(1, 100),
            'url_Archivo_Situacion_Academica_Actual' => $this->faker->url,'url_Archivo_Dictamen_Medico' => $this->faker->url,'url_Archivo_Diagnostico' => $this->faker->url,
            'carreras_simultaneas' => '1',
            'realizo_Traslado_Carrera' => '1',
            'descripcion' => $this->faker->sentence,
            'fecha' => '2020-01-01',
        ];
    }
}
