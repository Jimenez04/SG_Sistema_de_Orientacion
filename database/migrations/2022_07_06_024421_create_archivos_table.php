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
        Schema::create('archivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->string('expedido_Por',50)->nullable();
            $table->timestamps();
        });
        Schema::table('archivos', function (Blueprint $table) {
            $table->unsignedBigInteger('adecuacion_Solicitud_Id')->nullable();
            $table->foreign('adecuacion_Solicitud_Id')->references('id')->on('solicitud_de_adecuacions');
       });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
};
