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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->timestamps();
        });
        Schema::table('bitacoras', function (Blueprint $table) {
            $table->unsignedBigInteger('revision_Solicitud_Id')->nullable();
            $table->foreign('revision_Solicitud_Id')->references('id')->on('revision__solicituds')->onUpdate('cascade')
            ->onDelete('cascade');;

            $table->unsignedBigInteger('pai_Solicitud_Id')->nullable();
            $table->foreign('pai_Solicitud_Id')->references('id')->on('plan__de__accion__individuals')->onUpdate('cascade')
            ->onDelete('cascade');;
            
            $table->string('estudiante_carnet')->nullable();
            $table->foreign('estudiante_carnet')->references('carnet')->on('estudiantes')->onUpdate('cascade')
            ->onDelete('cascade');;
       });

        Schema::table('item__bitacoras', function (Blueprint $table) {
            $table->unsignedBigInteger('bitacora_Id')->nullable();
            $table->foreign('bitacora_Id')->references('id')->on('bitacoras')->onUpdate('cascade')
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
        Schema::dropIfExists('bitacoras');
    }
};
