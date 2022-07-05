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
            $table->unsignedBigInteger('N_id')->nullable();
        });

        Schema::table('seguimientos',function (Blueprint $table){
           $table->foreign('N_id')->references('id')->on('necesidad__y__apoyos');
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
