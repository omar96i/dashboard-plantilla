<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
			'nombre' => 'producto 1',
			'descripcion' => 'descripcion producto 1',
			'referencia' => 'referencia producto 1',
			'marca' => 'marca producto 1',
			'color' => 'color producto 1',
			'temperatura_calor' => 'temperatura producto 1',
			'voltaje' => '15',
			'cantidad' => '300',
			'foto' => 'default.png',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);

        DB::table('productos')->insert([
			'nombre' => 'producto 2',
			'descripcion' => 'descripcion producto 2',
			'referencia' => 'referencia producto 2',
			'marca' => 'marca producto 2',
			'color' => 'color producto 2',
			'temperatura_calor' => 'temperatura producto 2',
			'voltaje' => '15',
			'cantidad' => '300',
			'foto' => 'default.png',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);

        DB::table('productos')->insert([
			'nombre' => 'producto 3',
			'descripcion' => 'descripcion producto 3',
			'referencia' => 'referencia producto 3',
			'marca' => 'marca producto 3',
			'color' => 'color producto 3',
			'temperatura_calor' => 'temperatura producto 3',
			'voltaje' => '15',
			'cantidad' => '300',
			'foto' => 'default.png',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);

        DB::table('productos')->insert([
			'nombre' => 'producto 4',
			'descripcion' => 'descripcion producto 4',
			'referencia' => 'referencia producto 4',
			'marca' => 'marca producto 4',
			'color' => 'color producto 4',
			'temperatura_calor' => 'temperatura producto 4',
			'voltaje' => '15',
			'cantidad' => '300',
			'foto' => 'default.png',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
    }
}
