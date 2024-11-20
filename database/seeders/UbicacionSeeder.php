<?php

namespace Database\Seeders;

use App\Models\Ubicacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ubicacion::create([
            'id_ubicacion' => 1,
            'direccion' => 'Av. Principal 123',
            'distrito' => 'Miraflores',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 2,
            'direccion' => 'Calle Secundaria 456',
            'distrito' => 'San Isidro',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 3,
            'direccion' => 'Jr. Los Robles 789',
            'distrito' => 'Surco',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 4,
            'direccion' => 'Av. Las Flores 321',
            'distrito' => 'La Molina',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 5,
            'direccion' => 'Calle Los Olivos 654',
            'distrito' => 'San Borja',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 6,
            'direccion' => 'Jr. Las Rosas 987',
            'distrito' => 'San Miguel',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 7,
            'direccion' => 'Av. Los Cedros 147',
            'distrito' => 'Pueblo Libre',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 8,
            'direccion' => 'Calle Los Pinos 258',
            'distrito' => 'Magdalena',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 9,
            'direccion' => 'Jr. Las Palmeras 369',
            'distrito' => 'Jesús María',
            'ciudad' => 'Lima',
        ]);

        Ubicacion::create([
            'id_ubicacion' => 10,
            'direccion' => 'Av. El Sol 741',
            'distrito' => 'Rímac',
            'ciudad' => 'Lima',
        ]);
    }
}
