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
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('descripcion_Seguimiento');
            $table->longText('descripcion_Atencion');
            $table->timestamps();
            $table->unsignedBigInteger('necesidad_Y_Apoyo_id')->nullable();
        });

        Schema::table('seguimientos',function (Blueprint $table){
           $table->foreign('necesidad_Y_Apoyo_id')->references('id')->on('necesidad__y__apoyos')->onUpdate('cascade')
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
        Schema::dropIfExists('seguimientos');
    }
};
