<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('ano_Ingreso');
            $table->integer('nivel_Carrera');
            $table->boolean('estado');
            $table->integer('orden');
            $table->timestamps();
            $table->integer('carrera_id');

            $table->string('estudiante_carnet');        
        });
        Schema::table('carreras',function (Blueprint $table){
            $table->foreign('estudiante_carnet')->references('carnet')->on('estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
};
