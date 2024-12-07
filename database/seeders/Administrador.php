<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Administrador extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Insertar el administrador relacionado con el usuario
         DB::table('administrador')->insert([
            'dni' => '12345678',
            'nombres' => 'Hector',
            'apellidos' => 'Castro',
            'telefono' => '987654321',
            'id_usuario' => 1, // Relacionado con el usuario creado arriba
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
