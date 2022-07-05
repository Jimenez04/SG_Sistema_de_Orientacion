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
        Schema::create('necesidad__y__apoyos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('diagnostico');
            $table->string('profesional_Que_Diagnostico');
            $table->date('area_Profesional');
            $table->timestamps();
        });

    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('necesidad__y__apoyos');
    }
};
