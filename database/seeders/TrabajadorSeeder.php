<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    public function run(): void
    {
        Trabajador::create([
            'id_trabajador' => '10003',
            'nombres_t' => 'Carlos',
            'apellidos_t' => 'Martínez',
            'oficio_tmp' => 'Albañilería',
            'telefono' => '998877665',
            'tipo_documento' => 'DNI',
            'num_documento' => '23456789',
            'puntuacion' => 3  // Puntuación específica para Carlos
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10004',
            'nombres_t' => 'Luis',
            'apellidos_t' => 'Rodríguez',
            'oficio_tmp' => 'Albañilería',
            'telefono' => '912345678',
            'tipo_documento' => 'DNI',
            'num_documento' => '34567890',
            'puntuacion' => 4  // Puntuación específica para Luis
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10005',
            'nombres_t' => 'Ana',
            'apellidos_t' => 'Sánchez',
            'oficio_tmp' => 'Albañilería',
            'telefono' => '976543210',
            'tipo_documento' => 'DNI',
            'num_documento' => '45678901',
            'puntuacion' => 5  // Puntuación específica para Ana
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10006',
            'nombres_t' => 'Pedro',
            'apellidos_t' => 'Fernández',
            'oficio_tmp' => 'Carpintería',
            'telefono' => '987654321',
            'tipo_documento' => 'DNI',
            'num_documento' => '56789012',
            'puntuacion' => 2  // Puntuación específica para Pedro
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10007',
            'nombres_t' => 'Marta',
            'apellidos_t' => 'Pérez',
            'oficio_tmp' => 'Carpintería',
            'telefono' => '912345679',
            'tipo_documento' => 'DNI',
            'num_documento' => '67890123',
            'puntuacion' => 3  // Puntuación específica para Marta
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10008',
            'nombres_t' => 'Juan',
            'apellidos_t' => 'López',
            'oficio_tmp' => 'Carpintería',
            'telefono' => '943210987',
            'tipo_documento' => 'DNI',
            'num_documento' => '78901234',
            'puntuacion' => 4  // Puntuación específica para Juan
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10009',
            'nombres_t' => 'Roberto',
            'apellidos_t' => 'Vázquez',
            'oficio_tmp' => 'Pintura',
            'telefono' => '965432109',
            'tipo_documento' => 'DNI',
            'num_documento' => '89012345',
            'puntuacion' => 4  // Puntuación específica para Roberto
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10010',
            'nombres_t' => 'Susana',
            'apellidos_t' => 'García',
            'oficio_tmp' => 'Pintura',
            'telefono' => '976543210',
            'tipo_documento' => 'DNI',
            'num_documento' => '90123456',
            'puntuacion' => 5  // Puntuación específica para Susana
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10011',
            'nombres_t' => 'Diego',
            'apellidos_t' => 'Moreno',
            'oficio_tmp' => 'Pintura',
            'telefono' => '943210876',
            'tipo_documento' => 'DNI',
            'num_documento' => '12345679',
            'puntuacion' => 3  // Puntuación específica para Diego
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10012',
            'nombres_t' => 'Ricardo',
            'apellidos_t' => 'González',
            'oficio_tmp' => 'Cerrajería',
            'telefono' => '987654321',
            'tipo_documento' => 'DNI',
            'num_documento' => '23456780',
            'puntuacion' => 4  // Puntuación específica para Ricardo
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10013',
            'nombres_t' => 'Laura',
            'apellidos_t' => 'Santos',
            'oficio_tmp' => 'Cerrajería',
            'telefono' => '912345678',
            'tipo_documento' => 'DNI',
            'num_documento' => '34567891',
            'puntuacion' => 3  // Puntuación específica para Laura
        ]);
        
        Trabajador::create([
            'id_trabajador' => '10014',
            'nombres_t' => 'Fernando',
            'apellidos_t' => 'Gómez',
            'oficio_tmp' => 'Cerrajería',
            'telefono' => '976543210',
            'tipo_documento' => 'DNI',
            'num_documento' => '45678902',
            'puntuacion' => 2  // Puntuación específica para Fernando
        ]);
        
        // Agrega más registros según tus necesidades
    }
}
