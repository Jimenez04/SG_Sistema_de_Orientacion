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
            'numero_Solicitud' => $this->faker->numberBetween(1, 100),
            'razon_Solicitud' => $this->faker->sentence,
            'carrera_Empadronada'=> $this->faker->word ,
            'carrera_Solicitada' => $this->faker->word,
            'realizo_Traslado_Carrera' => 'no',
            'descripcion' => $this->faker->sentence,
            'url_Archivo_Situacion_Academica_Actual',
            'url_Archivo_Dictamen_Medico',
            'url_Archivo_Diagnostico',
            'fecha' => $this->faker->datetime,
            'solicitud_numero' => $this->faker->numberBetween(1, 10000),
        ];
    }
}
