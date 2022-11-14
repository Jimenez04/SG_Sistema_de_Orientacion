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
        Schema::create('trabajos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("actividad_Que_Desempena",80);
            $table->string("lugar_De_Trabajo", 40);
            $table->longText("horario_Laboral");
            $table->timestamps();
        });
        Schema::table('personas',function (Blueprint $table){
            $table->unsignedBigInteger("trabajo_id")->nullable(); 
            $table->foreign('trabajo_id')->references('id')->on('trabajos')->onUpdate('cascade')
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
        Schema::dropIfExists('trabajos');
    }
};
