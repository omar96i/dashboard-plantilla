<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoInterventoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_interventorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('usuario_id');
            $table->date('fecha_inicio');
            $table->time('hora_inicio');
            $table->date('fecha_final');
            $table->time('hora_final');
            $table->string('checkout_1')->nullable();
            $table->text('descripcion_1')->nullable();
            $table->string('checkout_2')->nullable();
            $table->text('descripcion_2')->nullable();
            $table->text('firma_cliente')->nullable();
            $table->text('firma_operario')->nullable();
            $table->timestamps();
            $table
                ->foreign('proyecto_id')
                ->references('id')
                ->on('proyectos')
                ->onDelete('cascade');
            $table
                ->foreign('usuario_id')
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
        Schema::dropIfExists('proyecto_interventorias');
    }
}
