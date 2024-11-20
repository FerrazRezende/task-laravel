<?php

namespace Database\Seeders;

use App\Models\Tarefas;
use Illuminate\Database\Seeder;

class TarefasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarefas::factory()->count(50)->create();
    }
}
