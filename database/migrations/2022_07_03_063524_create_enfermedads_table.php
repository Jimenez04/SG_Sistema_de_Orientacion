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
        Schema::create('enfermedads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("tipo_Enfermedad");
            $table->longText("descripcion");
            $table->longText("tratamiento");
            $table->longText("rutina_Tratamiento");
            $table->timestamps();
            $table->string('persona_cedula',20);

        });
        Schema::table('enfermedads',function (Blueprint $table){
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
        Schema::dropIfExists('enfermedads');
    }
};
