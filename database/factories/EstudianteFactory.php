<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'carnet' => $this->faker->unique()->randomNumber(8),
            'id_Rol' => $this->faker->numberBetween(1, 3),
            'ano_Ingreso' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'profesor_Consejero' => $this->faker->name,
        ];
    }
}
