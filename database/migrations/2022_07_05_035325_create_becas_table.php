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
        Schema::create('becas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('categoria_Beca');
            $table->string('asistencia_Socioeconomica')->nullable();
            $table->string('participacion')->nullable();
            $table->timestamps();
        });
        Schema::table('becas',function (Blueprint $table){
            $table->string('estudiante_carnet')->nullable();        
            $table->foreign('estudiante_carnet')->references('carnet')->on('estudiantes')->onUpdate('cascade')
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
        Schema::dropIfExists('becas');
    }
};
