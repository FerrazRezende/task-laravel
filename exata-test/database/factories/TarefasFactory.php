<?php

namespace Database\Factories;

use App\Enums\StatusTarefa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefas>
 */
class TarefasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descricao' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(StatusTarefa::values()),
            'data_criacao' => now()->setTimezone('America/Sao_Paulo')->toDateTimeString(),
            'data_modificacao' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
