<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrador>
 */
class AdministradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->unique()->numberBetween(1,100),
            'id_Rol'=>$this->faker->numberBetween(1,100),
        ];
    }
}
