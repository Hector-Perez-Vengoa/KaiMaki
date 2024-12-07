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
        Schema::create('imagenes_solicitudes', function (Blueprint $table) {
            $table->id('id_imagen'); // unsigned BIGINT automáticamente
            $table->unsignedBigInteger('id_solicitudes'); // Foreign Key
            $table->string('ruta_imagen');
            $table->timestamps();

            // Relación (Foreign Key)
            $table->foreign('id_solicitudes')->references('id_solicitudes')->on('solicitudes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_solicitudes');
    }
};
