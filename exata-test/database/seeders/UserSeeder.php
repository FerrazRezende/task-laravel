<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Cria o admin padrão e 10 usuarios aleatórios do factory
        User::create([
            'nome' => 'Administrador',
            'nome_usuario' => 'admin',
            'password' => Hash::make('12345678'),
            'admin' => true,
            'data_criacao' => now(),
        ]);

        User::factory(10)->create();
    }
}
