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
            $table->string('nombre_Carrera');
            $table->string('semestre');
            $table->longText('que_Espera_Del_Plan')->nullable();
            $table->string('nombreoficina')->nullable();
            $table->boolean('salud_Como_Impedimento')->nullable();
            $table->string('comentarios_Presentes_Reunion')->nullable();
            $table->string('profesional_VidaEstudiantil')->nullable();
            $table->string('estado');
            $table->timestamps();
        });
            //DB::unprepared('ALTER TABLE `plan__de__accion__individuals` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `numero_Solicitud` )');
            
        Schema::table('plan__de__accion__individuals',function (Blueprint $table){
            $table->string('estudiante_Carnet')->nullable();
            $table->foreign('estudiante_Carnet')->references('carnet')->on('estudiantes')->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->unsignedBigInteger('administrador_Id')->nullable();
            $table->foreign('administrador_Id')->references('id')->on('administradors')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('curso__rezagos',function (Blueprint $table){
            $table->string('solicitud_Numero')->nullable();
            $table->foreign('solicitud_Numero')->references('numero_Solicitud')->on('plan__de__accion__individuals')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('salud__fisica__emocionals',function (Blueprint $table){
            $table->string('plan_De_Accion_N_Solicitud')->nullable();
            $table->foreign('plan_De_Accion_N_Solicitud')->references('numero_Solicitud')->on('plan__de__accion__individuals')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        
        Schema::table('archivos', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_De_Accion_Id')->nullable();
            $table->foreign('plan_De_Accion_Id')->references('id')->on('plan__de__accion__individuals')->onUpdate('cascade')
            ->onDelete('cascade');;
       });
       
       Schema::table('vida__estudiantils', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_De_Accion_Id')->nullable();
            $table->foreign('plan_De_Accion_Id')->references('id')->on('plan__de__accion__individuals')->onUpdate('cascade')
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
        Schema::dropIfExists('plan__de__accion__individuals');
    }
};
