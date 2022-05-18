<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoActividadAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_actividad_asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actividad_id');
            $table->unsignedBigInteger('user_id');
            $table->text('latitude');
            $table->text('longitude');
            $table->text('url');
            $table->date('fecha')->useCurrent();
            $table->time('time')->useCurrent();
            $table->timestamps();

            $table
                ->foreign('actividad_id')
                ->references('id')
                ->on('proyecto_actividades')
                ->onDelete('cascade');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('proyecto_actividad_asistencias');
    }
}
