<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function(Blueprint $table){
            $table->increments('id');
            $table->integer('area_laboral_id');
            $table->integer('puesto_id');
            $table->string('username', 85);
            $table->string('passwd', 85);
            $table->string('nombre', 50);
            $table->string('paterno', 50);
            $table->string('materno', 50)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('email', 85)->nullable();
            $table->boolean('activo')->default(1);
            $table->dateTime('fecha_creado')->nullable();
            $table->dateTime('fecha_modificado')->nullable();
            $table->foreign('area_laboral_id')->references('id')->on('area_laboral');
            $table->foreign('puesto_id')->references('id')->on('puesto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuario');
    }
}
