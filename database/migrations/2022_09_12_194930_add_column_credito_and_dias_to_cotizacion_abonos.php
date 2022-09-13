<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCreditoAndDiasToCotizacionAbonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cotizacion_abonos', function (Blueprint $table) {
            $table->string('credito')->after('observacion')->nullable();
            $table->string('dias')->after('credito')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotizacion_abonos', function (Blueprint $table) {
            $table->dropColumn('credito');
            $table->dropColumn('dias');
        });
    }
}
