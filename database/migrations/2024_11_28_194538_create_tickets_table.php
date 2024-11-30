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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('id_tickets');
            $table->foreignId('id_usuario')->constrained()->onDelete('cascade'); // Relacionado con el usuario
            $table->enum('estado', ['abierto', 'en progreso', 'cerrado'])->default('abierto');
            $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media');
            $table->string('asunto'); // Título del ticket
            $table->text('descripcion'); // Descripción del problema
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
