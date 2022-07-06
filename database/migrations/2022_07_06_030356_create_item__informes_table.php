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
        Schema::create('item__informes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::table('item__informes', function (Blueprint $table) {
            $table->unsignedBigInteger('revision_Solicitud_Id')->nullable();
            $table->foreign('revision_Solicitud_Id')->references('id')->on('revision__solicituds');

            $table->unsignedBigInteger('expediente_Solicitud_Id')->nullable();
            $table->foreign('expediente_Solicitud_Id')->references('id')->on('expediente__plan__de__accions');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item__informes');
    }
};
