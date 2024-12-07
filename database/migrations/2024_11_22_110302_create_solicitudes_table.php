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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id('id_solicitudes'); // unsigned BIGINT automáticamente
            $table->unsignedBigInteger('id_estado_solicitudes'); // Foreign Key unsigned
            $table->unsignedBigInteger('id_trabajadores'); // Foreign Key unsigned
            $table->unsignedBigInteger('id_cliente'); // Foreign Key unsigned
            $table->date('fech_reserva');
            $table->text('descripcion');
            $table->time('hora_inicio_propuesta');
            $table->timestamps();
        
            // Relaciones (Foreign Keys)
            $table->foreign('id_estado_solicitudes')->references('id_estado_solicitudes')->on('estado_solicitudes');
            $table->foreign('id_trabajadores')->references('id_trabajadores')->on('trabajadores');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
