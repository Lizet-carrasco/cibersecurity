<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesPosgradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes_posgrados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('posgrado_id')->nullable()->unsigned();
            $table->foreign('posgrado_id')->references('id')->on('posgrados');
            $table->integer('tema_id')->nullable()->unsigned();
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->string('nombre',250)->nullable();
            $table->string('enlace_plan',250)->nullable();
            $table->string('periodo_inicio',4)->nullable();
            $table->string('periodo_fin',4)->nullable();    
            $table->integer('vigencia')->nullable();         
            $table->integer('estado')->nullable();            
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('planes_posgrados');
    }
}
