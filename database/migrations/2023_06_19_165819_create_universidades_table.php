<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',250)->nullable();
            $table->string('sigla',12)->nullable();
            $table->string('logo',80)->nullable();
            $table->string('departamento',50)->nullable();
            $table->string('provincia',100)->nullable();
            $table->string('distrito',100)->nullable();
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
        Schema::drop('universidades');
    }
}
