<?php

namespace Database\Seeders;

use App\Models\EstadoProblema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoProblemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoProblema::create([
            'id_estado_problema' => 1,
            'nombre_estado' => 'Pendiente',
        ]);

        EstadoProblema::create([
            'id_estado_problema' => 2,
            'nombre_estado' => 'En proceso',
        ]);

        EstadoProblema::create([
            'id_estado_problema' => 3,
            'nombre_estado' => 'Resuelto',
        ]);

        EstadoProblema::create([
            'id_estado_problema' => 4,
            'nombre_estado' => 'Cancelado',
        ]);

        EstadoProblema::create([
            'id_estado_problema' => 5,
            'nombre_estado' => 'Urgente',
        ]);
    }
}
