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
             $table->unsignedBigInteger('administrador_Id')->nullable();
             $table->foreign('administrador_Id')->references('id')->on('administradors')->onUpdate('cascade')
             ->onDelete('cascade');;

             $table->string('solicitud_Numero')->nullable();
             $table->foreign('solicitud_Numero')->references('numero_solicitud')->on('solicitud_de_adecuacions')->onUpdate('cascade')
             ->onDelete('cascade');;
        });
        Schema::table('recomendaciones', function (Blueprint $table) {
             $table->unsignedBigInteger('revision_Solicitud_id')->nullable();
                $table->foreign('revision_Solicitud_id')->references('id')->on('revision__solicituds')->onUpdate('cascade')
                ->onDelete('cascade');;
        });
        Schema::table('observacions', function (Blueprint $table) {
             $table->unsignedBigInteger('revision_Solicitud_id')->nullable();
                $table->foreign('revision_Solicitud_id')->references('id')->on('revision__solicituds')->onUpdate('cascade')
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
        Schema::dropIfExists('revision__solicituds');
    }
};
