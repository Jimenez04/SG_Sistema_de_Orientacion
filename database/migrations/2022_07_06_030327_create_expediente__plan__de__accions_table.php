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
        Schema::create('expediente__plan__de__accions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->timestamps();
        });

        Schema::table('expediente__plan__de__accions', function (Blueprint $table) {
            $table->string('solicitud_Numero')->nullable();
            $table->foreign('solicitud_Numero')->references('numero_Solicitud')->on('plan__de__accion__individuals')->onUpdate('cascade')
            ->onDelete('cascade');;

            $table->unsignedBigInteger('administrador_Id')->nullable();
            $table->foreign('administrador_Id')->references('id')->on('administradors')->onUpdate('cascade')
            ->onDelete('cascade');;
        });

        Schema::table('valoracions', function (Blueprint $table) {
            $table->unsignedBigInteger('expediente_Plan_De_Accion_Id')->nullable();
            $table->foreign('expediente_Plan_De_Accion_Id')->references('id')->on('expediente__plan__de__accions')->onUpdate('cascade')
            ->onDelete('cascade');;
        });

        Schema::table('plan__intervencions', function (Blueprint $table) {
            $table->unsignedBigInteger('expediente_Plan_De_Accion_Id')->nullable();
            $table->foreign('expediente_Plan_De_Accion_Id')->references('id')->on('expediente__plan__de__accions')->onUpdate('cascade')
            ->onDelete('cascade');;
        });

        Schema::table('grupo__familiars', function (Blueprint $table) {
            $table->unsignedBigInteger('expediente_Solicitud_Id')->nullable();
            $table->foreign('expediente_Solicitud_Id')->references('id')->on('expediente__plan__de__accions')->onUpdate('cascade')
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
        Schema::dropIfExists('expediente__plan__de__accions');
    }
};
