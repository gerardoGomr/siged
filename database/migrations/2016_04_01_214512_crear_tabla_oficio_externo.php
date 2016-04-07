<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaOficioExterno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficio_externo', function(Blueprint $tabla) {
            $tabla->increments('id');
            $tabla->date('fecha');
            $tabla->string('numero');
            $tabla->string('remitente');
            $tabla->string('cargo');
            $tabla->string('asunto');
            $tabla->string('destinatario');
            $tabla->dateTime('fecha_creado')->nullable();
            $tabla->dateTime('fecha_modificado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('oficio_externo');
    }
}
