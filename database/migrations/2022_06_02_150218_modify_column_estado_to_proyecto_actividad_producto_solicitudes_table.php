<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnEstadoToProyectoActividadProductoSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyecto_actividad_producto_solicitudes', function (Blueprint $table) {
            $table->string('estado')->default('solicitud')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyecto_actividad_producto_solicitudes', function (Blueprint $table) {
        });
    }
}
