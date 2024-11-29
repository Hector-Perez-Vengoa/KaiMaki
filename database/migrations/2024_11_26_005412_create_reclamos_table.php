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
        Schema::create('reclamos', function (Blueprint $table) {
            $table->id('id_reclamo');
            $table->date('fech_reclamo');
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->foreign('id_administrador')->references('id_administrador')->on('administrador')->onDelete('set null');
            
            $table->unsignedBigInteger('id_estado_reclamo')->nullable();
            $table->foreign('id_estado_reclamo')->references('id_estado_reclamo')->on('estado_reclamos')->onDelete('cascade');

            $table->unsignedBigInteger('id_solicitudes')->nullable();
            $table->foreign('id_solicitudes')->references('id_solicitudes')->on('solicitudes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamos');
    }
};
