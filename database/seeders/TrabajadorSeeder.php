<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use App\Models\Trabajadores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    public function run(): void
    {
        Trabajadores::create([
            'dni' => '75341205',
            'nombres' => 'Jose',
            'apellidos' => 'Gomez',
            'puntuacion' => 3,
            'telefono' => '912345678',
            'sexo'=> 'M',
            'id_ubicacion' => 1,
            'id_usuario' => 1,
        ]);

        Trabajadores::create([
            'dni' => '65478932',
            'nombres' => 'Carlos',
            'apellidos' => 'Ramirez',
            'puntuacion' => 4,
            'telefono' => '922334455',
            'sexo'=> 'M',
            'id_ubicacion' => 2,
            'id_usuario' => 2,

        ]);

        Trabajadores::create([
            'dni' => '81234567',
            'nombres' => 'Luis',
            'apellidos' => 'Martinez',
            'puntuacion' => 5,
            'telefono' => '933445566',
            'sexo'=> 'M',
            'id_ubicacion' => 3,
            'id_usuario' => 3,
        ]);

        Trabajadores::create([
            'dni' => '98765432',
            'nombres' => 'Maria',
            'apellidos' => 'Lopez',
            'puntuacion' => 4,
            'telefono' => '944556677',
            'sexo'=> 'F',
            'id_ubicacion' => 4,
            'id_usuario' => 4,
        ]);

        Trabajadores::create([
            'dni' => '56341234',
            'nombres' => 'Ana',
            'apellidos' => 'Perez',
            'puntuacion' => 3,
            'telefono' => '955667788',
            'sexo'=> 'F',
            'id_ubicacion' => 5,
            'id_usuario' => 5,
        ]);

        Trabajadores::create([
            'dni' => '73451298',
            'nombres' => 'Pedro',
            'apellidos' => 'Garcia',
            'puntuacion' => 5,
            'telefono' => '966778899',
            'sexo'=> 'M',
            'id_ubicacion' => 6,
            'id_usuario' => 6,
        ]);

        Trabajadores::create([
            'dni' => '84123569',
            'nombres' => 'Sofia',
            'apellidos' => 'Rios',
            'puntuacion' => 4,
            'telefono' => '977889900',
            'sexo'=> 'F',
            'id_ubicacion' => 7,
            'id_usuario' => 7,
        ]);

        Trabajadores::create([
            'dni' => '98127364',
            'nombres' => 'Javier',
            'apellidos' => 'Torres',
            'puntuacion' => 3,
            'telefono' => '988990011',
            'sexo'=> 'M',
            'id_ubicacion' => 8,
            'id_usuario' => 8,
        ]);

        Trabajadores::create([
            'dni' => '67234589',
            'nombres' => 'Lucia',
            'apellidos' => 'Fernandez',
            'puntuacion' => 5,
            'telefono' => '999001122',
            'sexo'=> 'F',
            'id_ubicacion' => 9,
            'id_usuario' => 9,
        ]);

        Trabajadores::create([
            'dni' => '75419823',
            'nombres' => 'Miguel',
            'apellidos' => 'Castro',
            'puntuacion' => 4,
            'telefono' => '910112233',
            'sexo'=> 'M',
            'id_ubicacion' => 10,
            'id_usuario' => 10,
        ]);
        


        // Agrega más registros según tus necesidades
    }
}
