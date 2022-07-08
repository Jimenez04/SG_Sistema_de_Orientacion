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
        Schema::create('carrera__u_c_r_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('coordinador');
            $table->string('telefono');
            $table->integer('bloques');
            $table->integer('creditos');
            $table->timestamps();
        });
        
        Schema::table('curso_u_c_r_s',function (Blueprint $table){
            $table->unsignedBigInteger("carrera_id")->nullable(); 
            $table->foreign('carrera_id')->references('id')->on('carrera__u_c_r_s');
        });
        //DB::unprepared('ALTER TABLE `curso_u_c_r_s` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id` ,  `carrera_id` )');


        Schema::table('carreras',function (Blueprint $table){
            $table->unsignedBigInteger("carrera_id")->nullable(); 
            $table->foreign('carrera_id')->references('id')->on('carrera__u_c_r_s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrera__u_c_r_s');
    }
};
