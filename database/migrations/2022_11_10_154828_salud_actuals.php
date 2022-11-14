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
        Schema::create('salud_actuals', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->boolean('afectacionDesempeno');
            $table->longText('enfermedad')->nullable();
            $table->longText('tratamiento')->nullable();
            $table->timestamps();
        });

        Schema::table('salud_actuals',function (Blueprint $table){
            $table->unsignedBigInteger('adecuacion_Solicitud_Id')->nullable();
            $table->foreign('adecuacion_Solicitud_Id')->references('id')->on('solicitud_de_adecuacions')->onUpdate('cascade')
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
        Schema::dropIfExists('salud_actuals');
    }
};
