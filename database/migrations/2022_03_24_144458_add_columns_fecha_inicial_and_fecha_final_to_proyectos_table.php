<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsFechaInicialAndFechaFinalToProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->date('fecha_inicial')->after('nombre');
            $table->date('fecha_final')->after('fecha_inicial');
            $table->string('estado')->after('fecha_final');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('fecha_inicial');
            $table->dropColumn('fecha_final');
            $table->dropColumn('estado');
        });
    }
}
