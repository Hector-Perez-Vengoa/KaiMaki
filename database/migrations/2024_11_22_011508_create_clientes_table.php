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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente'); // PK

            $table->string('nom_cliente', 100);
            $table->string('ape_cliente', 100);
            $table->string('telefo_cliente', 9)->unique();
            $table->string('dni', 8)->unique();
            $table->enum('sexo', ['M', 'F']);
            $table->unsignedBigInteger('id_ubicacion')->nullable(); // Clave foránea
            $table->unsignedBigInteger('id_usuario')->nullable();

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
        Schema::dropIfExists('clientes');
    }
};
