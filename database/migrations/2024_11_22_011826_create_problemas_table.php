<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemasTable extends Migration
{
    public function up()
    {
        Schema::create('problemas', function (Blueprint $table) {
            $table->id('id_problemas');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_oficios');
            $table->text('descripcion');
            $table->decimal('monto', 10, 2)->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('id_estado_problema');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_oficios')->references('id_oficios')->on('oficios')->onDelete('cascade');
            $table->foreign('id_estado_problema')->references('id_estado_problema')->on('estado_problema')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('problemas');
    }
}
