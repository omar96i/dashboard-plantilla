<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSubValorToProductoValores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_valores', function (Blueprint $table) {
            $table->integer('sub_valor')->after('valor')->default('0');
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
            $table->dropColumn('sub_valor');
        });
    }
}
