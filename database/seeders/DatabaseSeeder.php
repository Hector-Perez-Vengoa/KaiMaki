<?php

namespace Database\Seeders;

use App\Models\EstadoUsers;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            EstadoUsersSeeder::class,      // Crear estado: Usersss
            RolesSeeder::class,             // Crear roles
            UserSeeder::class,              // Crear usuarios y asignar roles

            EstadoCertificadoSeeder::class,// Crear estados para certificados
            EstadoAntecedentesSeeder::class,// Crear estados para antecedentes
            EstadoSolicitudesSeeder::class,// Crear estados para solicitudes
    
            OficiosSeeder::class,           // Crear oficios
            EstadoProblemaSeeder::class,
            UbicacionSeeder::class,       // Crear ubicaciones
            TrabajadorSeeder::class,        // Crear trabajadores
            TrabajadorOficioSeeder::class,// Crear la relación entre trabajadores y oficios
            CertificadosSeeder::class,      // Crear certificados
            AntecedentesSeeder::class,      // Crear antecedentes

        ]);
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    }
}
