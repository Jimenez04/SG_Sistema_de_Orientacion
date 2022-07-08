<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera>
 */
class CarreraFactory extends Factory
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
        'ano_Ingreso' => $this->faker->dateTime(),
        'nivel_Carrera' => '90',
        'estado' => '1',
        'orden' => '1',
        ];
    }
}
