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
        Schema::create('trabajadores_oficio', function (Blueprint $table) {
            $table->unsignedBigInteger('id_trabajadores');
            $table->unsignedBigInteger('id_oficios');
            $table->timestamps();

    // Definición de claves foráneas
            $table->foreign('id_trabajadores')
                    ->references('id_trabajadores')->on('trabajadores')
                    ->onDelete('cascade'); // Elimina automáticamente relaciones en cascada

            $table->foreign('id_oficios')
                ->references('id_oficios')->on('oficios')
                ->onDelete('cascade'); // Elimina automáticamente relaciones en cascada

    // Índice único para evitar duplicados
            $table->primary(['id_trabajadores', 'id_oficios']);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores_oficio');
    }
};
