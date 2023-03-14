<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        return [
            'nomeCompleto' => fake()->name(),
            'nomeMae' => fake()->name('female'),
            'dataNascimento' => fake()->dateTimeBetween('1990-01-01', '2012-12-31'),
            'cpf' => $faker->cpf, // password
            'cns' => random_int(111,999),
        ];
    }
}
