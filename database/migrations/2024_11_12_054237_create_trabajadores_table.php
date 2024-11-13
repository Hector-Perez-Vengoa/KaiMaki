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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id('id_trabajador');
            $table->string('nombres_t');
            $table->string('apellidos_t');
            $table->string('oficio_tmp');
            $table->integer('puntuacion');
            $table->integer('telefono');
            $table->string('tipo_documento');
            $table->string('num_documento')->unique();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
