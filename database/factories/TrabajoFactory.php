<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trabajo>
 */
class TrabajoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 100),
            'trabajo_Actual' => $this->faker->word,
            'actividad_Que_Desempena' => $this->faker->sentence,
            'lugar_De_Trabajo' => 'Liberia',
            'jornada_Trabajo' => 'Como Burro',
            'horario_Laboral' => 'full',
        ];
    }
}
