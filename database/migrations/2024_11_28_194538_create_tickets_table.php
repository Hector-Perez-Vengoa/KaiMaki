<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * RPara arreglar migraciones no subir.
     */
    public function up()
    {
        if (!Schema::hasTable('tickets')) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id('id_tickets');
                $table->unsignedBigInteger('id_usuario');
                $table->enum('estado', ['abierto', 'en progreso', 'cerrado'])->default('abierto');
                $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media');
                $table->string('asunto');
                $table->text('descripcion');
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
