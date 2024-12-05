<?php

namespace Database\Seeders;

use App\Models\EstadoReclamos as ModelsEstadoReclamos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoReclamos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsEstadoReclamos::create([
            'id_estado_reclamo' => 1,
            'nombre_estado' => 'Atendido',
        ]);

        ModelsEstadoReclamos::create([
            'id_estado_reclamo' => 2,
            'nombre_estado' => 'Pendiente',
        ]);

        ModelsEstadoReclamos::create([
            'id_estado_reclamo' => 3,
            'nombre_estado' => 'Rechazado',
        ]);

        ModelsEstadoReclamos::create([
            'id_estado_reclamo' => 4,
            'nombre_estado' => 'En Revisión',
        ]);

        ModelsEstadoReclamos::create([
            'id_estado_reclamo' => 5,
            'nombre_estado' => 'Anulado',
        ]);
    }
}
