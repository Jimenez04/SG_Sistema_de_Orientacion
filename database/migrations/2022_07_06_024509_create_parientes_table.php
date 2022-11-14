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
            $table->string('ocupacion',50);
            $table->timestamps();
        });
        Schema::table('parientes', function (Blueprint $table) {
            $table->string('persona_cedula',20)->nullable();
            $table->foreign('persona_cedula')->references('cedula')->on('personas')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('grupo_Familiar_Id')->nullable();
            $table->foreign('grupo_Familiar_Id')->references('id')->on('grupo__familiars')->onUpdate('cascade')
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
        Schema::dropIfExists('parientes');
    }
};
