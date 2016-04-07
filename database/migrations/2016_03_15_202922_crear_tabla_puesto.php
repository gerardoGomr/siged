<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puesto', function(Blueprint $tabla) {
            $tabla->increments('id');
            $tabla->string('puesto');
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
        //Schema::drop('puesto');
    }
}
