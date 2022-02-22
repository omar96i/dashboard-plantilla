<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCotizacionesProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_cotizaciones_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('sub_cotizacion_id');
            $table->string('cantidad');
            $table->string('estado');
            $table->timestamps();

            $table
                ->foreign('producto_id')
                ->references('id')
                ->on('productos')
                ->onDelete('cascade');

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
        Schema::dropIfExists('sub_cotizaciones_productos');
    }
}
