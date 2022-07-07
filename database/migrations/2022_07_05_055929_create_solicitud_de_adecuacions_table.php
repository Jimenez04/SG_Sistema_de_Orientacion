<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('solicitud_de_adecuacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_solicitud')->unique();
            $table->string('razon_Solicitud');
            $table->integer('carrera_Empadronada');
            $table->boolean('carreras_simultaneas');
            $table->boolean('realizo_Traslado_Carrera');
            $table->longText('descripcion');
            $table->string('url_Archivo_Situacion_Academica_Actual');
            $table->string('url_Archivo_Dictamen_Medico');
            $table->string('url_Archivo_Diagnostico');
            $table->datetime('fecha');
            $table->timestamps();
            $table->string('estudiante_carnet',20);
        });

        Schema::table('solicitud_de_adecuacions',function (Blueprint $table){
            $table->foreign('estudiante_carnet')->references('carnet')->on('estudiantes');
        });
        DB::unprepared('ALTER TABLE `solicitud_de_adecuacions` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `numero_solicitud` )');
        
        Schema::table('necesidad__y__apoyos',function (Blueprint $table){
            $table->string('solicitud_numero');
            $table->foreign('solicitud_numero')->references('numero_solicitud')->on('solicitud_de_adecuacions');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_de_adecuacions');
    }
};
