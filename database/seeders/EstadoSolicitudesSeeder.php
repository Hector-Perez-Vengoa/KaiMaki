<?php

namespace Database\Seeders;

use App\Models\EstadoSolicitud;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSolicitudesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoSolicitud::insert([
            ['id_estado_solicitudes' => 1, 'nombre_estado' => 'Pendiente'],
            ['id_estado_solicitudes' => 2, 'nombre_estado' => 'En Proceso'],
            ['id_estado_solicitudes' => 3, 'nombre_estado' => 'Completado'],
            ['id_estado_solicitudes' => 4, 'nombre_estado' => 'Cancelado'],
            ['id_estado_solicitudes' => 5, 'nombre_estado' => 'Negociacion Cliente'],
            ['id_estado_solicitudes' => 6, 'nombre_estado' => 'Negociacion Trabajador'],
        ]);
    }
}