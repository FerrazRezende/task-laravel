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
        $users = [
            [
                'nome' => 'Administrador',
                'nome_usuario' => 'admin',
                'password' => Hash::make('12345678'),
                'admin' => true,
            ],
            [
                'nome' => 'João Silva',
                'nome_usuario' => 'joaosilva',
                'password' => Hash::make('senha123'),
                'admin' => false,
            ],
            [
                'nome' => 'Maria Oliveira',
                'nome_usuario' => 'mariaoliveira',
                'password' => Hash::make('maria123'),
                'admin' => false,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
