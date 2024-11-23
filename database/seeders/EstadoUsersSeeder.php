<?php

namespace Database\Seeders;

use App\Models\EstadoUsers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoUsers::create([
            'id_estado_users' => 1,
            'nombre_estado' => 'Aprobado',
        ]);

        EstadoUsers::create([
            'id_estado_users' => 2,
            'nombre_estado' => 'Pendiente',
        ]);

        EstadoUsers::create([
            'id_estado_users' => 3,
            'nombre_estado' => 'Rechazado',
        ]);
    }
}
