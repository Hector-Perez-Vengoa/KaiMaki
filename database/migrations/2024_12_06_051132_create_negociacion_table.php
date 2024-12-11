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
            $table->decimal('monto', 10, 2)->default(0); // Campo para el monto
            $table->date('nueva_fech_reserva')->nullable(); // Permitir nulos
            $table->time('hora_inicio')->nullable(); // Permitir nulos
            $table->time('tiempo_estimado')->nullable(); // Permitir nulos
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
