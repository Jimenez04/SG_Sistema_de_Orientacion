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
        Schema::create('vida__estudiantils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profesional_Encargado',50);
            $table->string('horario_Atencion',50);
            $table->timestamps();
        });
        Schema::table('contactos', function (Blueprint $table) {
            $table->unsignedBigInteger('vida_Estudiantil_Id')->nullable();
            $table->foreign('vida_Estudiantil_Id')->references('id')->on('vida__estudiantils')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('emails', function (Blueprint $table) {
            $table->unsignedBigInteger('vida_Estudiantil_Id')->nullable();
            $table->foreign('vida_Estudiantil_Id')->references('id')->on('vida__estudiantils')->onUpdate('cascade')
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
        Schema::dropIfExists('vida__estudiantils');
    }
};
