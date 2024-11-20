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
        Schema::table('certificados', function (Blueprint $table) {
            // Agregar la columna de clave foránea
            $table->unsignedBigInteger('id_trabajadores')->nullable()->after('id_certificados');

            // Definir la clave foránea
            $table->foreign('id_trabajadores')
                  ->references('id_trabajadores')->on('trabajadores')
                  ->onDelete('set null'); // Si se elimina el trabajador, el campo se establece en NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificados', function (Blueprint $table) {

                        // Eliminar la clave foránea
            $table->dropForeign(['id_trabajadores']);
                        // Eliminar la columna
            $table->dropColumn('id_trabajadores');
        });
    }
};
