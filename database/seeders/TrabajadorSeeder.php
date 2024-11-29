<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use App\Models\Trabajadores;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    public function run(): void
    {

// Datos de los trabajadores
$trabajadores = [
    [
        'dni' => '65478932',
        'nombres' => 'Carlos',
        'apellidos' => 'Ramirez',
        'puntuacion' => 4,
        'telefono' => '922334455',
        'sexo' => 'M',
        'id_ubicacion' => 1,
    ],
    [
        'dni' => '81234567',
        'nombres' => 'Luis',
        'apellidos' => 'Martinez',
        'puntuacion' => 5,
        'telefono' => '933445566',
        'sexo' => 'M',
        'id_ubicacion' => 2,
    ],
    [
        'dni' => '98765432',
        'nombres' => 'Maria',
        'apellidos' => 'Lopez',
        'puntuacion' => 4,
        'telefono' => '944556677',
        'sexo' => 'F',
        'id_ubicacion' => 3,
    ],
    [
        'dni' => '56341234',
        'nombres' => 'Ana',
        'apellidos' => 'Perez',
        'puntuacion' => 3,
        'telefono' => '955667788',
        'sexo' => 'F',
        'id_ubicacion' => 4,
    ],
    [
        'dni' => '73451298',
        'nombres' => 'Pedro',
        'apellidos' => 'Garcia',
        'puntuacion' => 5,
        'telefono' => '966778899',
        'sexo' => 'M',
        'id_ubicacion' => 5,
    ],
];

// Obtener todos los usuarios con id_roles = 2 (Trabajadores)
$usuariosTrabajadores = User::where('id_roles', 2)->get();

// Relacionar cada trabajador con un usuario
foreach ($trabajadores as $index => $data) {
    // Verifica que el usuario correspondiente existe
    $usuario = $usuariosTrabajadores->skip($index)->first();

    if ($usuario) {
        Trabajadores::create(array_merge($data, [
            'id_usuario' => $usuario->id, // Relacionar con el ID del usuario
        ]));
    }
}
}

      

}
