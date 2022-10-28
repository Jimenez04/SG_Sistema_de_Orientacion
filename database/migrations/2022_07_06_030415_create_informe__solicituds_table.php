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
        Schema::create('informe__solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->longText('descripcion');
            $table->timestamps();
        });
        Schema::table('item__informes', function (Blueprint $table) {
            $table->unsignedBigInteger('informe_Id')->nullable();
            $table->foreign('informe_Id')->references('id')->on('informe__solicituds')->onUpdate('cascade')
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
        Schema::dropIfExists('informe__solicituds');
    }
};
