<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            // $table->dropColumn('numero'); // preguntar sobre este campo
            $table->renameColumn('codigo_letra', 'codigo_utopia'); // preguntar sobre este campo
            $table->string('ubicacion')->after('foto')->nullable();  // crud de ubicaciones o quemadas en el dormulario?
            $table->string('provedor')->after('ubicacion')->nullable();
            $table->text('observacion')->after('provedor')->nullable();
            $table->string('barcode')->after('observacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            // $table->integer('numero');
            $table->renameColumn('codigo_utopia', 'codigo_letra');
            $table->dropColumn('ubicacion');
            $table->dropColumn('provedor');
            $table->dropColumn('observacion');
            $table->dropColumn('barcode');
        });
    }
}
