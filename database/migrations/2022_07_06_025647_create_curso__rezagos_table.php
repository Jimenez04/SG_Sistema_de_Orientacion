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
        Schema::create('curso__rezagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('solicitud_Numero');
            $table->unsignedBigInteger('curso_Id');
            $table->string('grupo');
            $table->string('docente');
            $table->integer('numero_De_Matriculas');
            $table->integer('numero_De_Culminaciones');
            $table->longText('aspectos_Y_Condiciones_Rezago');
            $table->integer('actitud_Estudiante');
            $table->longText('resumen_No_Aprobar_El_Curso');
            $table->timestamps();
        });
        Schema::table('formulario__valoracion__academicas', function (Blueprint $table) {
            $table->unsignedBigInteger('pregunta_Id');
            $table->foreign('pregunta_Id')->references('id')->on('preguntas__valoracions');
            
            $table->unsignedBigInteger('curso__Rezago_Id');
            $table->foreign('curso__Rezago_Id')->references('id')->on('curso__rezagos');

       });

       Schema::table('actitud__estudiantes', function (Blueprint $table) {
        $table->unsignedBigInteger('curso_Rezago_Id');
        $table->foreign('curso_Rezago_Id')->references('id')->on('curso__rezagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso__rezagos');
    }
};
