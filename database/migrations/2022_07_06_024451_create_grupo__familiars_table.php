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
        Schema::create('grupo__familiars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('descripcion_De_Discapacidades');
            $table->timestamps();
        });
        Schema::table('grupo__familiars', function (Blueprint $table) {
            $table->string('adecuacion_Solicitud_Numero')->nullable();
            $table->foreign('adecuacion_Solicitud_Numero')->references('numero_solicitud')->on('solicitud_de_adecuacions');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo__familiars');
    }
};
