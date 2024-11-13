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
        Schema::table('users', function (Blueprint $table) {
            $table -> unsignedBigInteger('id_roles');
            $table ->foreign('id_roles')->references('id')-> on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la clave foránea primero
            $table->dropForeign(['id_roles']);
        
            // Luego eliminar la columna
            $table->dropColumn('id_roles'); 
        });
    }
};
