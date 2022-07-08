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
        Schema::create('revision__solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->string('estado');
            $table->timestamps();
        });
        Schema::table('revision__solicituds', function (Blueprint $table) {
             $table->string('administrador_Cedula',20)->nullable();
             $table->foreign('administrador_Cedula')->references('persona_cedula')->on('administradors');

             $table->string('solicitud_Numero')->nullable();
             $table->foreign('solicitud_Numero')->references('numero_solicitud')->on('solicitud_de_adecuacions');
        });
        Schema::table('recomendaciones', function (Blueprint $table) {
             $table->unsignedBigInteger('revision_Solicitud_id')->nullable();
                $table->foreign('revision_Solicitud_id')->references('id')->on('revision__solicituds');
        });
        Schema::table('observacions', function (Blueprint $table) {
             $table->unsignedBigInteger('revision_Solicitud_id')->nullable();
                $table->foreign('revision_Solicitud_id')->references('id')->on('revision__solicituds');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revision__solicituds');
    }
};
