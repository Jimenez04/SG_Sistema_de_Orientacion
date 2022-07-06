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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->timestamps();
        });
        Schema::table('bitacoras', function (Blueprint $table) {
            $table->unsignedBigInteger('revision_Solicitud_Id')->nullable();
            $table->foreign('revision_Solicitud_Id')->references('id')->on('revision__solicituds');

            $table->unsignedBigInteger('expediente_Solicitud_Id')->nullable();
            $table->foreign('expediente_Solicitud_Id')->references('id')->on('expediente__plan__de__accions');
       });

            Schema::table('item__bitacoras', function (Blueprint $table) {
            $table->unsignedBigInteger('bitacora_Id')->nullable();
            $table->foreign('bitacora_Id')->references('id')->on('bitacoras');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacoras');
    }
};
