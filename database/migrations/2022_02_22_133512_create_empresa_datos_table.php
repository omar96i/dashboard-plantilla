<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_datos', function (Blueprint $table) {
            $table->id();
            $table->string('razon');
            $table->string('nit');
            $table->string('telefono');
            $table->string('cuenta_corriente');
            $table->string('email');
            $table->string('estado')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_datos');
    }
}
