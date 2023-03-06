<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndModifyColumnsProductoIdAndSubCotizacionProductoIdToProyectoActividadProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyecto_actividad_productos', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_cotizacion_producto_id')->nullable()->change();
            $table->unsignedBigInteger('producto_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyecto_actividad_productos', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_cotizacion_producto_id')->change();
            $table->dropForeign(['producto_id']);
            $table->dropColumn('producto_id');
        });
    }
}
