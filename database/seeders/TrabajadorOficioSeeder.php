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
            'id_trabajadores' => 1, // Carlos
            'id_oficios' => 2,      // Plomero
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 2, // Luis
            'id_oficios' => 3,      // Carpintero
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 3, // Maria
            'id_oficios' => 4,      // Pintor
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 4, // Ana
            'id_oficios' => 5,      // Jardinero
        ]);

        DB::table('trabajadores_oficio')->insert([
            'id_trabajadores' => 5, // Pedro
            'id_oficios' => 6,      // Cerrajero
        ]);

    }
}
