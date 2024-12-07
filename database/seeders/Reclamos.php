<?php

namespace Database\Seeders;

use App\Models\Reclamos as ModelsReclamos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Reclamos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Insertar datos en la tabla 'reclamos'
         DB::table('reclamos')->insert([
            [
                'asunto' => 'Problema con el sistema de pago',
                'descripcion' => 'El sistema de pagos no está funcionando correctamente y no puedo realizar compras.',
                'fech_reclamo' => Carbon::now()->subDays(5), // Fecha de hace 5 días
                'id_administrador' => 1, // Ejemplo de id de administrador
                'id_estado_reclamo' => 2, // Ejemplo de id de estado de reclamo
                'id_usuario' => 3, // Ejemplo de id de usuario
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asunto' => 'Retrasos en la entrega',
                'descripcion' => 'El pedido realizado hace una semana aún no ha llegado.',
                'fech_reclamo' => Carbon::now()->subDays(10), // Fecha de hace 10 días
                'id_administrador' => 1, // Ejemplo de id de administrador
                'id_estado_reclamo' => 3, // Ejemplo de id de estado de reclamo
                'id_usuario' => 4, // Ejemplo de id de usuario
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asunto' => 'Error en el servicio de atención al cliente',
                'descripcion' => 'El servicio de atención al cliente no me brindó una solución satisfactoria.',
                'fech_reclamo' => Carbon::now()->subDays(15), // Fecha de hace 15 días
                'id_administrador' => 1, // No asignado a ningún administrador
                'id_estado_reclamo' => 1, // Ejemplo de id de estado de reclamo
                'id_usuario' => 5, // Ejemplo de id de usuario
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
