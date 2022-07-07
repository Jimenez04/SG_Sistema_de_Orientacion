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
        Schema::create('parientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_Pariente',50);
            $table->string('discapacidad_Si_Presenta',50);
            $table->timestamps();
        });
        Schema::table('parientes', function (Blueprint $table) {
            $table->string('persona_cedula',20);
            $table->foreign('persona_cedula')->references('cedula')->on('personas');

            $table->unsignedBigInteger('grupo_Familiar_Id');
            $table->foreign('grupo_Familiar_Id')->references('id')->on('grupo__familiars');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parientes');
    }
};
