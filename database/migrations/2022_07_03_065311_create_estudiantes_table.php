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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string("carnet",20)->primary()->unique();
            $table->string("carnet_S")->unique();
            $table->dateTime("ano_Ingreso")->nullable();
            $table->string("profesor_Consejero")->nullable();
            $table->timestamps();
            $table->string('persona_cedula',20)->nullable();
        });
        Schema::table('estudiantes',function (Blueprint $table){
            $table->foreign('persona_cedula')->references('cedula')->on('personas')->onUpdate('cascade')
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
        Schema::dropIfExists('estudiantes');
    }
};
