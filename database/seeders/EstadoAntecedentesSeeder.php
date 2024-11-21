<?php

namespace Database\Seeders;

use App\Models\EstadoAntecedentes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoAntecedentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoAntecedentes::create([
            'id_estado_antecedentes' => 1,
            'nombre_estado' => 'Aprobado',
        ]);

        EstadoAntecedentes::create([
            'id_estado_antecedentes' => 2,
            'nombre_estado' => 'Pendiente',
        ]);

        EstadoAntecedentes::create([
            'id_estado_antecedentes' => 3,
            'nombre_estado' => 'Rechazado',
        ]);
    }
}
