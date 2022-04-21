<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoActividadProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_actividad_productos', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('sub_cotizacion_producto_id');
            $table->unsignedBigInteger('proyecto_actividad_id');
            $table->string('cantidad');
            $table->string('estado')->default('activo');
            $table->timestamps();

            $table
                ->foreign('sub_cotizacion_producto_id')
                ->references('id')
                ->on('sub_cotizaciones_productos')
                ->onDelete('cascade');

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
        Schema::dropIfExists('proyecto_actividad_productos');
    }
}
