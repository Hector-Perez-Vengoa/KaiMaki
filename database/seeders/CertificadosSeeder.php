<?php

namespace Database\Seeders;

use App\Models\Certificados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificados::create([
            'id_trabajadores' => 1,
            'documento_certificado' => 'certificado_electricista.pdf',
            'id_estado_certificados' => 1, // Estado ejemplo: aprobado
        ]);
        Certificados::create([
            'id_trabajadores' => 2, // ID del trabajador asociado
            'documento_certificado' => 'certificado_plomero.pdf',
            'id_estado_certificados' => 2, // Estado ejemplo: pendiente
        ]);
        
        Certificados::create([
            'id_trabajadores' => 3, // ID del trabajador asociado
            'documento_certificado' => null, // No tiene documento asociado
            'id_estado_certificados' => 3, // Estado ejemplo: rechazado
        ]);
        
        Certificados::create([
            'id_trabajadores' => 4, // ID del trabajador asociado
            'documento_certificado' => 'certificado_pintor.pdf',
            'id_estado_certificados' => 1, // Estado ejemplo: aprobado
        ]);
        
        Certificados::create([
            'id_trabajadores' => 5, // ID del trabajador asociado
            'documento_certificado' => 'certificado_carpintero.pdf',
            'id_estado_certificados' => 2, // Estado ejemplo: pendiente
        ]);
        
        Certificados::create([
            'id_trabajadores' => 6, // ID del trabajador asociado
            'documento_certificado' => 'certificado_jardinero.pdf',
            'id_estado_certificados' => 1, // Estado ejemplo: aprobado
        ]);
        
        Certificados::create([
            'id_trabajadores' => 7, // ID del trabajador asociado
            'documento_certificado' => 'certificado_cerrajero.pdf',
            'id_estado_certificados' => 2, // Estado ejemplo: pendiente
        ]);
        
        Certificados::create([
            'id_trabajadores' => 8, // ID del trabajador asociado
            'documento_certificado' => 'certificado_mecanico.pdf',
            'id_estado_certificados' => 3, // Estado ejemplo: rechazado
        ]);
        
        Certificados::create([
            'id_trabajadores' => 9, // ID del trabajador asociado
            'documento_certificado' => 'certificado_albanil.pdf',
            'id_estado_certificados' => 1, // Estado ejemplo: aprobado
        ]);
        
        Certificados::create([
            'id_trabajadores' => 10, // ID del trabajador asociado
            'documento_certificado' => 'certificado_tecnico.pdf',
            'id_estado_certificados' => 2, // Estado ejemplo: pendiente
        ]);
               


    }
}
