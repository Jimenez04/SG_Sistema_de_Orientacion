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
        Schema::create('item__bitacoras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('descripcion')->nullable();
            $table->longText('acciones_realizadas')->nullable();
            $table->longText('observaciones')->nullable();
            $table->dateTime('fecha');
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
        Schema::dropIfExists('item__bitacoras');
    }
};
