<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoActividadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_actividad_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_actividad_id');
            $table->text('file');
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign('proyecto_actividad_id')
                ->references('id')
                ->on('proyecto_actividades')
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
        Schema::dropIfExists('proyecto_actividad_files');
    }
}
