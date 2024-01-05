<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniversidadIdToFacultadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facultades', function (Blueprint $table) {
            $table->integer('universidad_id')->nullable()->unsigned();
            $table->foreign('universidad_id')->references('id')->on('universidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facultades', function (Blueprint $table) {
            //
        });
    }
}
