<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCantidadUsadaToSubCotizacionesProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_cotizaciones_productos', function (Blueprint $table) {
            $table->integer('cantidad_usada')->after('cantidad')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_cotizaciones_productos', function (Blueprint $table) {
            $table->dropColumn('cantidad_usada');
        });
    }
}
