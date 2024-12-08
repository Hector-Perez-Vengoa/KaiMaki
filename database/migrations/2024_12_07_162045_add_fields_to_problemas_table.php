<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProblemasTable extends Migration
{
    public function up()
    {
        Schema::table('problemas', function (Blueprint $table) {
            $table->string('ubicacion_alternativa')->nullable()->after('id_cliente'); // Nueva ubicación
            $table->boolean('urgente')->default(false)->after('id_estado_problema'); // Urgencia
            $table->date('fecha_reserva')->nullable()->after('fecha'); // Fecha para solucionar
        });
    }

    public function down()
    {
        Schema::table('problemas', function (Blueprint $table) {
            $table->dropColumn('ubicacion_alternativa');
            $table->dropColumn('urgente');
            $table->dropColumn('fecha_reserva');
        });
    }
}
