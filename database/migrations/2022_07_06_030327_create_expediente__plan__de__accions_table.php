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
        Schema::create('expediente__plan__de__accions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->timestamps();
        });

        Schema::table('expediente__plan__de__accions', function (Blueprint $table) {
            $table->string('solicitud_Numero');
            $table->foreign('solicitud_Numero')->references('numero_Solicitud')->on('plan__de__accion__individuals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expediente__plan__de__accions');
    }
};
