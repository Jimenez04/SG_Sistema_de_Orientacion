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
        Schema::create('cierre__intervencions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('especificacion_De_Cierre');
            $table->longText('conclusiones_finales');
            $table->longText('recomendaciones');
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
        Schema::dropIfExists('cierre__intervencions');
    }
};
