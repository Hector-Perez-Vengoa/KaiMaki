<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Crear usuarios con diferentes roles
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 1,
        ]);

        // Crear 5 usuarios trabajadores
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Trabajador $i",
                'email' => "trabajador$i@example.com",
                'password' => bcrypt('password'),
                'id_roles' => 2, // Rol de Trabajador
                'id_estado_users'=>2
            ]);
        }

        // Crear 4 usuarios clientes
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Cliente $i",
                'email' => "cliente$i@example.com",
                'password' => bcrypt('password'),
                'id_roles' => 3, // Rol de Cliente
                'id_estado_users'=>2
            ]);
        }
    }
}
