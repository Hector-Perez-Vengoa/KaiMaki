<?php

namespace Database\Seeders;

use App\Models\TrabajadorOficio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrabajadorOficioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 1, // Jose
            'id_oficios' => 1,      // Electricista
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 2, // Carlos
            'id_oficios' => 2,      // Plomero
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 3, // Luis
            'id_oficios' => 3,      // Carpintero
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 4, // Maria
            'id_oficios' => 4,      // Pintor
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 5, // Ana
            'id_oficios' => 5,      // Jardinero
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 6, // Pedro
            'id_oficios' => 6,      // Cerrajero
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 7, // Sofia
            'id_oficios' => 7,      // Mecánico
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 8, // Javier
            'id_oficios' => 8,      // Albañil
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 9, // Lucia
            'id_oficios' => 9,      // Técnico de electrodomésticos
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 10, // Miguel
            'id_oficios' => 10,      // Servicio de limpieza
        ]);

    }
}
