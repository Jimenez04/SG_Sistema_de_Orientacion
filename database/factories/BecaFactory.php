<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beca>
 */
class BecaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'id' => $this->faker->numberBetween(1, 100),
        'categoria_Beca' => '5',
        'asistencia_Socioeconomica' => $this->faker->word,
        'participacion' => $this->faker->word,
        ];
    }
}
