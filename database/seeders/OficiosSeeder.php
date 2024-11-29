<?php

namespace Database\Seeders;

use App\Models\Oficios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OficiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Oficios::create([
            'id_oficios' => 1,
            'nombre_oficio' => 'Electricista',
        ]);

        Oficios::create([
            'id_oficios' => 2,
            'nombre_oficio' => 'Plomero',
        ]);

        Oficios::create([
            'id_oficios' => 3,
            'nombre_oficio' => 'Carpintero',
        ]);

        Oficios::create([
            'id_oficios' => 4,
            'nombre_oficio' => 'Pintor',
        ]);

        Oficios::create([
            'id_oficios' => 5,
            'nombre_oficio' => 'Jardinero',
        ]);

        Oficios::create([
            'id_oficios' => 6,
            'nombre_oficio' => 'Cerrajero',
        ]);

    }
}
