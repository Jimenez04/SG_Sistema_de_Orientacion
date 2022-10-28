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
            $table->string('carrera_Empadronada');
            $table->boolean('carreras_simultaneas');
            $table->boolean('realizo_Traslado_Carrera');
            $table->longText('descripcion');
            $table->string('url_Archivo_Situacion_Academica_Actual')->nullable();
            $table->string('url_Archivo_Dictamen_Medico')->nullable();
            $table->string('url_Archivo_Diagnostico')->nullable();
            $table->timestamps();
            $table->string('estudiante_carnet',20)->nullable();
        });

        Schema::table('solicitud_de_adecuacions',function (Blueprint $table){
            $table->foreign('estudiante_carnet')->references('carnet')->on('estudiantes')->onUpdate('cascade')
            ->onDelete('cascade');
        });
        //DB::unprepared('ALTER TABLE `solicitud_de_adecuacions` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `numero_solicitud` )');
        
        Schema::table('necesidad__y__apoyos',function (Blueprint $table){
            $table->string('solicitud_numero')->nullable();
            $table->foreign('solicitud_numero')->references('numero_solicitud')->on('solicitud_de_adecuacions')->onUpdate('cascade')
            ->onDelete('cascade');;
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
