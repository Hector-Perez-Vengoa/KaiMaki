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

        User::create([
            'name' => 'Trabajador 1',
            'email' => 'trabajador1@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 2, // Rol de Trabajador
            'id_estado_users' => 2,
        ]);
        
        User::create([
            'name' => 'Trabajador 2',
            'email' => 'trabajador2@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 2, // Rol de Trabajador
            'id_estado_users' => 2,
        ]);
        
        User::create([
            'name' => 'Trabajador 3',
            'email' => 'trabajador3@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 2, // Rol de Trabajador
            'id_estado_users' => 2,
        ]);
        
        User::create([
            'name' => 'Trabajador 4',
            'email' => 'trabajador4@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 2, // Rol de Trabajador
            'id_estado_users' => 2,
        ]);
        
        User::create([
            'name' => 'Trabajador 5',
            'email' => 'trabajador5@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 2, // Rol de Trabajador
            'id_estado_users' => 2,
        ]);
        
        
        // Crear 5 usuarios clientes
        User::create([
            'name' => 'Cliente 1',
            'email' => 'cliente1@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 3, // Rol de Cliente
            'id_estado_users' => 1,
        ]);
        
        User::create([
            'name' => 'Cliente 2',
            'email' => 'cliente2@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 3, // Rol de Cliente
            'id_estado_users' => 1,
        ]);
        
        User::create([
            'name' => 'Cliente 3',
            'email' => 'cliente3@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 3, // Rol de Cliente
            'id_estado_users' => 1,
        ]);
        
        User::create([
            'name' => 'Cliente 4',
            'email' => 'cliente4@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 3, // Rol de Cliente
            'id_estado_users' => 1,
        ]);
        
        User::create([
            'name' => 'Cliente 5',
            'email' => 'cliente5@example.com',
            'password' => bcrypt('password'),
            'id_roles' => 3, // Rol de Cliente
            'id_estado_users' => 1,
        ]);
    }
}
