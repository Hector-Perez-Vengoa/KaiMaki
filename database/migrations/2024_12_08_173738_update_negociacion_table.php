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
        Schema::table('negociacion', function (Blueprint $table) {
            // Agregar campos adicionales para la negociación
            $table->boolean('cambio_fecha')->default(false)->after('mensaje'); // Indica si hubo un cambio de fecha
            $table->boolean('cambio_ubicacion')->default(false)->after('cambio_fecha'); // Indica si hubo un cambio de ubicación
            $table->text('ubicacion_nueva')->nullable()->after('cambio_ubicacion'); // Nueva ubicación si aplica

            $table->enum('estado_negociacion', ['En proceso', 'Aceptada', 'Rechazada', 'Cerrada'])
                  ->default('En proceso')
                  ->after('updated_at');
            $table->unsignedBigInteger('id_cliente')->nullable()->after('id_solicitudes');
            $table->unsignedBigInteger('id_trabajadores')->nullable()->after('id_cliente');

            // Foreign keys
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_trabajadores')->references('id_trabajadores')->on('trabajadores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('negociacion', function (Blueprint $table) {
            $table->dropColumn(['cambio_fecha', 'cambio_ubicacion', 'ubicacion_nueva']);
            $table->dropColumn('estado_negociacion');
            $table->dropForeign(['id_cliente']);
            $table->dropColumn('id_cliente');
            $table->dropForeign(['id_trabajador']);
            $table->dropColumn('id_trabajador');
        });


    }
};
