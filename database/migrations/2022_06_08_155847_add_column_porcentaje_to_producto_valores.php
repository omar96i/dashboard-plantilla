<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPorcentajeToProductoValores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_valores', function (Blueprint $table) {
            $table->integer('porcentaje')->after('sub_valor')->default('0');
            $table->decimal('valor',15,2)->change();
            $table->decimal('valor',15,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto_valores', function (Blueprint $table) {
            $table->dropColumn('porcentaje');
            $table->integer('valor')->change();
            $table->integer('sub_valor')->change();
        });
    }
}
