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

        User::create([
            'name' => 'Trabajador',
            'email' => 'trabajador@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 2,
        ]);

        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 3,
        ]); 
    }
}
