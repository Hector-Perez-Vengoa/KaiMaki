<?php

namespace Database\Seeders;

use App\Models\EstadoCertificados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoCertificadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoCertificados::create([
            'id_estado_certificados' => 1,
            'nombre_estado' => 'Aprobado',
        ]);

        EstadoCertificados::create([
            'id_estado_certificados' => 2,
            'nombre_estado' => 'Pendiente',
        ]);

        EstadoCertificados::create([
            'id_estado_certificados' => 3,
            'nombre_estado' => 'Rechazado',
        ]);

        EstadoCertificados::create([
            'id_estado_certificados' => 4,
            'nombre_estado' => 'En Revisión',
        ]);

        EstadoCertificados::create([
            'id_estado_certificados' => 5,
            'nombre_estado' => 'Anulado',
        ]);
    }
}
