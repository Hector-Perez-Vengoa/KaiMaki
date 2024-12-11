<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajoCampoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajo_campo', function (Blueprint $table) {
            $table->id('id_trabajo_campo'); // Primary key
            $table->unsignedBigInteger('id_solicitudes'); // Foreign key
            $table->time('hora_entrada')->nullable();
            $table->string('oficio_serv')->nullable();
            $table->time('hora_salida')->nullable();
            $table->decimal('monto', 10, 2)->nullable();
            $table->integer('puntuacion')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_solicitudes')
                ->references('id_solicitudes')
                ->on('solicitudes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajo_campo');
    }
}

