<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
			'name' => 'actividades.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'configuraciones.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'configuraciones.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'cotizaciones.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'cotizaciones.editar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'cotizaciones.eliminar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'cotizaciones.ver',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'cotizaciones.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.categorias.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.categorias.editar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.categorias.eliminar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.editar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.eliminar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.reabastecimientos',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.solicitudes',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'productos.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.acciones',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.asistencias',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.editar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.eliminar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.reagendamientos',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.reportes',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.solicitudes',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.ver',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.actividades.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.editar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.eliminar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.interventorias.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.planos',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.planos.admin',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.ver',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'proyectos.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'roles.permisos.asignar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'roles.permisos.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'roles.permisos.eliminar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'roles.permisos.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'usuario.crear',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'usuario.editar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'usuario.eliminar',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
        DB::table('permissions')->insert([
			'name' => 'usuario.view',
			'guard_name' => 'web',
			'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
			'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
		]);
    }
}
