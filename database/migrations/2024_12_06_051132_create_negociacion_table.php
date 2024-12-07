<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('negociacion', function (Blueprint $table) {
            $table->id('id_negociacion'); // Clave primaria
            $table->unsignedBigInteger('id_solicitudes'); // Foreign Key
            $table->decimal('monto', 10, 2); // Campo para el monto
            $table->date('nueva_fech_reserva'); // Nueva fecha de reserva
            $table->time('hora_inicio'); // Hora de inicio
            $table->time('tiempo_estimado'); // Tiempo estimado en minutos
            $table->text('mensaje');
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Relación con solicitudes
            $table->foreign('id_solicitudes')->references('id_solicitudes')->on('solicitudes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negociacion');
    }
};
