<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_laboral', function(Blueprint $tabla) {
            $tabla->increments('id');
            $tabla->string('nombre');
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
        Schema::drop('area_laboral');
    }
}
