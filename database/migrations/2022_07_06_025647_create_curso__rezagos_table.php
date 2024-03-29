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
            $table->string('grupo');
            $table->string('docente');
            $table->string('nombre_Curso');
            $table->integer('numero_De_Matriculas');
            $table->integer('numero_De_Culminaciones')->nullable();
            $table->longText('aspectos_Y_Condiciones_Rezago')->nullable();
            $table->integer('actitud_Estudiante')->nullable();
            $table->longText('resumen_No_Aprobar_El_Curso');
            $table->timestamps();
        });
        Schema::table('formulario__valoracion__academicas', function (Blueprint $table) {
            $table->unsignedBigInteger('pregunta_Id')->nullable();
            $table->foreign('pregunta_Id')->references('id')->on('preguntas__valoracions');
            
            $table->unsignedBigInteger('curso__Rezago_Id')->nullable();
            $table->foreign('curso__Rezago_Id')->references('id')->on('curso__rezagos')->onUpdate('cascade')
            ->onDelete('cascade');

       });

       Schema::table('actitud__estudiantes', function (Blueprint $table) {
        $table->unsignedBigInteger('curso_Rezago_Id')->nullable();
        $table->foreign('curso_Rezago_Id')->references('id')->on('curso__rezagos')->onUpdate('cascade')
        ->onDelete('cascade');
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
