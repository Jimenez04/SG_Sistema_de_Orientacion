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
        Schema::create('personas', function (Blueprint $table) {
            $table->string("cedula", 20)->primary()->unique();
            $table->string("nombre1", 20);
            $table->string("nombre2", 20)->nullable();
            $table->string("apellido1", 20);
            $table->string("apellido2", 20);
            $table->date("fecha_Nacimiento");
            $table->timestamps();           
        });
        Schema::table('personas',function (Blueprint $table){
            $table->unsignedBigInteger("user_id")->nullable(); 
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
