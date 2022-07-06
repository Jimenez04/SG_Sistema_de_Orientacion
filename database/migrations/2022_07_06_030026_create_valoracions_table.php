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
        Schema::create('valoracions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->string('persona_Solicitante_Plan_DeAccion',50);
            $table->longText('motivo_Intervencion');
            $table->longText('resumen_Valoracion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valoracions');
    }
};
