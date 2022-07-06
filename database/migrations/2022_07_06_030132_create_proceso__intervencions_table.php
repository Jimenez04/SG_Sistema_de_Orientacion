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
        Schema::create('proceso__intervencions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area_Intervencion',50);
            $table->longText('descripcion');
            $table->timestamps();
        });
        Schema::table('referencias__especialistas', function (Blueprint $table) {
            $table->unsignedBigInteger('proceso__Intervencion_id');
            $table->foreign('proceso__Intervencion_id')->references('id')->on('proceso__intervencions');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proceso__intervencions');
    }
};
