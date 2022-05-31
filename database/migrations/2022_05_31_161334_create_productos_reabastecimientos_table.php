<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosReabastecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_reabastecimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');
            $table->timestamps();
            $table
                ->foreign('producto_id')
                ->references('id')
                ->on('productos')
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
        Schema::dropIfExists('productos_reabastecimientos');
    }
}
