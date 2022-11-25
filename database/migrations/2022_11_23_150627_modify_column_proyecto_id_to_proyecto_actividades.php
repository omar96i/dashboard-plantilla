<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnProyectoIdToProyectoActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyecto_actividades', function (Blueprint $table) {
            $table->unsignedBigInteger('proyecto_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyecto_actividades', function (Blueprint $table) {
            $table->unsignedBigInteger('proyecto_id')->change();
        });
    }
}
