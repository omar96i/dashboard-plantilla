<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class InformacionPersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('informacion_personal')->insert([
			'user_id' => '1',
			'documento' => '1088',
			'nombres' => 'admin',
			'apellidos' => 'admin',
			'telefono' => '12345',
			'sexo' => 'hombre',
			'fecha_nacimiento' => '2022-03-01',
			'ciudad' => '2022-03-01',
			'foto' => 'default.jpg',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
    }
}
