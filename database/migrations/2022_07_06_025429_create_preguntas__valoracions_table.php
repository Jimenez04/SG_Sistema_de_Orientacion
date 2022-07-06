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
        Schema::create('preguntas__valoracions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('pregunta');
            $table->timestamps();
        });
        Schema::table('preguntas__valoracions', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_Id');
            $table->foreign('categoria_Id')->references('id')->on('categorias');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas__valoracions');
    }
};
