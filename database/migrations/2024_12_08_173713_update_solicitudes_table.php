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
        Schema::table('solicitudes', function (Blueprint $table) {
            // Agregar la columna para asociar una solicitud con un problema
            $table->unsignedBigInteger('id_problema')->after('id_cliente')->nullable();

            // Relación con la tabla problemas
            $table->foreign('id_problema')->references('id_problemas')->on('problemas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['id_problema']);
            $table->dropColumn('id_problema');
        });
    }
};
