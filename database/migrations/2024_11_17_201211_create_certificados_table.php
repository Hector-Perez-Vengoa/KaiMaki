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
        Schema::create('certificados', function (Blueprint $table) {
            $table->id('id_certificados');
            $table->string('documento_certificado', 255)->nullable();
            $table->unsignedBigInteger('id_estado_certificados')->nullable(); // Clave foránea
        
            $table->foreign('id_estado_certificados')
                  ->references('id_estado_certificados')
                  ->on('estado_certificados')
                  ->onDelete('cascade'); // Establece NULL si se elimina en la tabla padre
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};
