<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoActividadReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_actividad_reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('actividad_id');
            $table->string('cantidad');
            $table->text('descripcion');
            $table->date('fecha');
            $table->string('estado')->default('pendiente');
            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('producto_id')
                ->references('id')
                ->on('proyecto_actividad_productos')
                ->onDelete('cascade');

            $table
                ->foreign('actividad_id')
                ->references('id')
                ->on('proyecto_actividades')
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
        Schema::dropIfExists('proyecto_actividad_reportes');
    }
}
