<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDolarIdToCotizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('dolar_id')->after('empresa_datos_id')->default('1');
            $table
                ->foreign('dolar_id')
                ->references('id')
                ->on('dolar_valores')
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
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropForeign(['dolar_id']);
            $table->dropColumn('dolar_id');
        });
    }
}
