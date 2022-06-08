<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnProductoValorIdToSubCotizacionesProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_cotizaciones_productos', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_valor_id')->after('producto_id');
            $table
                ->foreign('producto_valor_id')
                ->references('id')
                ->on('producto_valores')
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
        Schema::table('sub_cotizaciones_productos', function (Blueprint $table) {
            $table->dropForeign(['producto_valor_id']);
            $table->dropColumn('producto_valor_id');
        });
    }
}
