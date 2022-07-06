<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MatAluMae extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matalumaes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('alumno_id')->nullable();
            $table->unsignedBigInteger('maestro_id')->nullable();
            $table->unsignedBigInteger('materia_id')->nullable();
            $table->foreign('alumno_id')->references('id')->on('users');
            $table->foreign('maestro_id')->references('id')->on('users');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->float('calificacion')->default(0,0);
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
        //
    }
}
