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
        Schema::create('institucion__procedencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->dateTime('ano_egreso');
            $table->timestamps();
        });
        Schema::table('institucion__procedencias', function (Blueprint $table) {
            $table->string('solicitud_Numero')->nullable();
            $table->foreign('solicitud_Numero')->references('numero_solicitud')->on('solicitud_de_adecuacions')->onUpdate('cascade')
            ->onDelete('cascade');;
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institucion__procedencias');
    }
};
