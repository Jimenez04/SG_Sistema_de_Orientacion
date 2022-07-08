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
            $table->string("carnet")->primary();
            $table->integer("id_Rol");
            $table->dateTime("ano_Ingreso");
            $table->string("profesor_Consejero");
            $table->timestamps();
            $table->string('persona_cedula',20)->nullable();
        });
        Schema::table('estudiantes',function (Blueprint $table){
            $table->foreign('persona_cedula')->references('cedula')->on('personas');
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
