<?php

namespace Database\Seeders;

use App\Models\Antecedentes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AntecedentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Antecedentes::create([
            'id_trabajadores' => 1,
            'documento_antecedente' => 'antecedente_penal_jose.pdf',
            'id_estado_antecedentes' => 1, // Estado ejemplo: aprobado
        ]);

        Antecedentes::create([
            'id_trabajadores' => 2,
            'documento_antecedente' => 'antecedente_penal_carlos.pdf',
            'id_estado_antecedentes' => 2, // Estado ejemplo: pendiente
        ]);

        Antecedentes::create([
            'id_trabajadores' => 3,
            'documento_antecedente' => null, // No tiene documento asociado
            'id_estado_antecedentes' => 3, // Estado ejemplo: rechazado
        ]);

        Antecedentes::create([
            'id_trabajadores' => 4,
            'documento_antecedente' => 'antecedente_penal_maria.pdf',
            'id_estado_antecedentes' => 1,
        ]);

        Antecedentes::create([
            'id_trabajadores' => 5,
            'documento_antecedente' => 'antecedente_penal_ana.pdf',
            'id_estado_antecedentes' => 2,
        ]);

        Antecedentes::create([
            'id_trabajadores' => 6,
            'documento_antecedente' => 'antecedente_penal_pedro.pdf',
            'id_estado_antecedentes' => 3,
        ]);

        Antecedentes::create([
            'id_trabajadores' => 7,
            'documento_antecedente' => 'antecedente_penal_sofia.pdf',
            'id_estado_antecedentes' => 1,
        ]);

        Antecedentes::create([
            'id_trabajadores' => 8,
            'documento_antecedente' => 'antecedente_penal_javier.pdf',
            'id_estado_antecedentes' => 2,
        ]);

        Antecedentes::create([
            'id_trabajadores' => 9,
            'documento_antecedente' => 'antecedente_penal_lucia.pdf',
            'id_estado_antecedentes' => 1,
        ]);

        Antecedentes::create([
            'id_trabajadores' => 10,
            'documento_antecedente' => 'antecedente_penal_miguel.pdf',
            'id_estado_antecedentes' => 3,
        ]);
    }
}
