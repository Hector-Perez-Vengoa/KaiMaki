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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_negociacion');
            $table->unsignedBigInteger('id_usuario');
            $table->text('contenido');
            $table->enum('tipo', ['texto', 'archivo'])->default('texto');
            $table->text('archivo_url')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_negociacion')->references('id_negociacion')->on('negociacion')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
