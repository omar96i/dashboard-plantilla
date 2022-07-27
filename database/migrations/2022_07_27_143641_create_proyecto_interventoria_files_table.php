<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoInterventoriaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_interventoria_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interventoria_id');
            $table->json('files');
            $table->timestamps();
            $table
                ->foreign('interventoria_id')
                ->references('id')
                ->on('proyecto_interventorias')
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
        Schema::dropIfExists('proyecto_interventoria_files');
    }
}
