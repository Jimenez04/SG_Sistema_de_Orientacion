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
            //DB::unprepared('ALTER TABLE `plan__de__accion__individuals` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `numero_Solicitud` )');
            
        Schema::table('plan__de__accion__individuals',function (Blueprint $table){
            $table->unsignedBigInteger('carrera_Id')->nullable();
            $table->foreign('carrera_Id')->references('id')->on('carrera__u_c_r_s');
            
            $table->string('estudiante_Carnet')->nullable();
            $table->foreign('estudiante_Carnet')->references('carnet')->on('estudiantes');
        });

        Schema::table('curso__rezagos',function (Blueprint $table){
            $table->unsignedBigInteger('curso_Id')->nullable();
            $table->foreign('curso_Id')->references('id')->on('curso_u_c_r_s');
            
            $table->string('solicitud_Numero')->nullable();
            $table->foreign('solicitud_Numero')->references('numero_Solicitud')->on('plan__de__accion__individuals');
        });

        Schema::table('salud__fisica__emocionals',function (Blueprint $table){
            $table->string('plan_De_Accion_N_Solicitud')->nullable();
            $table->foreign('plan_De_Accion_N_Solicitud')->references('numero_Solicitud')->on('plan__de__accion__individuals');
        });

        
        Schema::table('archivos', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_De_Accion_Id')->nullable();
            $table->foreign('plan_De_Accion_Id')->references('id')->on('plan__de__accion__individuals');
       });
       
       Schema::table('vida__estudiantils', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_De_Accion_Id')->nullable();
            $table->foreign('plan_De_Accion_Id')->references('id')->on('plan__de__accion__individuals');
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
