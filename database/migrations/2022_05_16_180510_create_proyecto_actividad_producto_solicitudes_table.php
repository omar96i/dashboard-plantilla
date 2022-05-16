<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoActividadProductoSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_actividad_producto_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actividad_id');
            $table->unsignedBigInteger('producto_id');
            $table->string('cantidad');
            $table->string('descripcion');
            $table->string('estado')->default('pedido');
            $table->timestamps();

            $table
                ->foreign('actividad_id')
                ->references('id')
                ->on('proyecto_actividades')
                ->onDelete('cascade');

            $table
                ->foreign('producto_id')
                ->references('id')
                ->on('productos')
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
        Schema::dropIfExists('proyecto_actividad_producto_solicitudes');
    }
}
