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
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id('id_antecedentes'); // Clave primaria
            $table->string('documento_antecedente', 255)->nullable();
            $table->unsignedBigInteger('id_trabajadores')->nullable(); // Clave foránea
            $table->unsignedBigInteger('id_estado_antecedentes')->nullable();
            
        
            // Clave foránea con trabajadores
            $table->foreign('id_trabajadores')
                  ->references('id_trabajadores')
                  ->on('trabajadores')
                  ->onDelete('cascade');
        
            // Clave foránea con estado_antecedentes
            $table->foreign('id_estado_antecedentes')
                  ->references('id_estado_antecedentes')
                  ->on('estado_antecedentes')
                  ->onDelete('cascade');
        
            $table->timestamps();
        });        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antecedentes', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['id_trabajadores']);
            // Eliminar la columna
            $table->dropColumn('id_trabajadores');
        });
    }
};
