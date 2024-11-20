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
            $table->id('id_trabajadores');
            $table->string('dni', 8)->unique();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->integer('puntuacion');
            $table->string('telefono', 9)->unique();
            $table->enum('sexo', ['M', 'F']);
            $table->unsignedBigInteger('id_ubicacion')->nullable(); // Clave foránea
            $table->unsignedBigInteger('id_usuario')->nullable();
            
            // Definición de claves foráneas
            $table->foreign('id_ubicacion')->references('id_ubicacion')->on('ubicacion')->onDelete('set null');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('set null');
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
