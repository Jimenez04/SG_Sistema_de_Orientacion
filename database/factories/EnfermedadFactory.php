<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enfermedad>
 */
class EnfermedadFactory extends Factory
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
            'tipo_Enfermedad' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'tratamiento' => $this->faker->sentence,
            'rutina_Tratamiento' => $this->faker->word,
        ];
    }
}
