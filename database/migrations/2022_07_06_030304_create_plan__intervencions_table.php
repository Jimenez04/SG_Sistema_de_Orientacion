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
        Schema::create('plan__intervencions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('accion_Planificada');
            $table->longText('cronograma');
            $table->boolean('estado');
            $table->longText('observaciones');
            $table->timestamps();
        });
        Schema::table('proceso__intervencions', function (Blueprint $table) {
            $table->unsignedBigInteger('plan__Intervencions_Id')->nullable();
            $table->foreign('plan__Intervencions_Id')->references('id')->on('plan__intervencions');
        });

        Schema::table('cierre__intervencions', function (Blueprint $table) {
            $table->unsignedBigInteger('plan__Intervencions_Id')->nullable();
            $table->foreign('plan__Intervencions_Id')->references('id')->on('plan__intervencions');
        });


        Schema::table('participantes', function (Blueprint $table) {
            $table->unsignedBigInteger('plan__Intervencion_Id')->nullable();
            $table->foreign('plan__Intervencion_Id')->references('id')->on('plan__intervencions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan__intervencions');
    }
};
