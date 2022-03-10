<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductoValorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('producto_valores')->insert([
			'producto_id' => '1',
			'valor' => '40',
			'tipo' => 'dolar',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);

        DB::table('producto_valores')->insert([
			'producto_id' => '2',
			'valor' => '40',
			'tipo' => 'dolar',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);

        DB::table('producto_valores')->insert([
			'producto_id' => '3',
			'valor' => '40000',
			'tipo' => 'peso_colombiano',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);

        DB::table('producto_valores')->insert([
			'producto_id' => '4',
			'valor' => '40000',
			'tipo' => 'peso_colombiano',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
    }
}
