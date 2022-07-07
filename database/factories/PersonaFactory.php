<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cedula' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'nombre1' => $this->faker->firstName,
            'nombre2' => $this->faker->firstName,
            'apellido1' => $this->faker->lastName,
            'apellido2' => $this->faker->lastName,
            'fecha_Nacimiento' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            //'id_Sexo' => $this->faker->numberBetween(1, 2),
            //'user_id' => $this->faker->numberBetween(1, 10),
            //'trabajo_id' => $this->faker->numberBetween(1, 10),
        ];	
    }
}
