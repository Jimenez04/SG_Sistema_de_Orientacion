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
        Schema::create('plan__de__accion__individuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_Solicitud')->unique();
            $table->integer('semestre');
            $table->longText('que_Espera_Del_Plan');
            $table->string('nombreoficina');
            $table->boolean('salud_Como_Impedimento');
            $table->string('comentarios_Presentes_Reunion');
            $table->timestamps();
        });
            DB::unprepared('ALTER TABLE `plan__de__accion__individuals` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `numero_Solicitud` )');
            
        Schema::table('plan__de__accion__individuals',function (Blueprint $table){
            $table->unsignedBigInteger('curso_Id');
            $table->foreign('curso_Id')->references('id')->on('curso_u_c_r_s');
            
            $table->string('estudiante_Carnet');
            $table->foreign('estudiante_Carnet')->references('carnet')->on('estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan__de__accion__individuals');
    }
};
