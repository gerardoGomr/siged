<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CrearTablaFolios
 * @author Gerardo Adrián Gómez Ruiz
 */
class CrearTablaFolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folio', function(Blueprint $tabla) {
            $tabla->increments('id');
            $tabla->integer('numero');
            $tabla->string('documento');
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
        //
    }
}
