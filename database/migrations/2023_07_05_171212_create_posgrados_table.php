<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosgradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posgrados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('universidad_id')->nullable()->unsigned();
            $table->foreign('universidad_id')->references('id')->on('universidades');
            $table->string('nombre_completo',250)->nullable();
            $table->string('mencion',20)->nullable();
            $table->string('tipo',10)->nullable();            
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
        Schema::drop('posgrados');
    }
}
