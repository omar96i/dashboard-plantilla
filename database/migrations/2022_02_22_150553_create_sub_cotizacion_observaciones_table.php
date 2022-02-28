<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCotizacionObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_cotizacion_observaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_cotizacion_id');
            $table->string('descripcion');
            $table->timestamps();

            $table
                ->foreign('sub_cotizacion_id')
                ->references('id')
                ->on('sub_cotizaciones')
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
        Schema::dropIfExists('sub_cotizacion_observaciones');
    }
}
