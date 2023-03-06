<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(InformacionPersonalSeeder::class);
        // $this->call(ProductoSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionsSeeder::class);

        $user = User::find(1);
        $user->assignRole('admin');


        $role = Role::find(1);
        $role->syncPermissions([
            'usuario.view',
            'configuraciones.view',
            'roles.permisos.view',
            'cotizaciones.view',
            'proyectos.view',
            'proyectos.actividades.view',
            'productos.view',
            'cotizaciones.crear',
            'cotizaciones.editar',
            'cotizaciones.eliminar',
            'cotizaciones.ver',
            'roles.permisos.crear',
            'roles.permisos.eliminar',
            'roles.permisos.asignar',
            'configuraciones.crear',
            'usuario.crear',
            'usuario.editar',
            'usuario.eliminar',
            'productos.crear',
            'productos.editar',
            'productos.eliminar',
            'productos.reabastecimientos',
            'productos.categorias.crear',
            'productos.categorias.editar',
            'productos.categorias.eliminar',
            'productos.solicitudes',
            'proyectos.crear',
            'proyectos.planos.admin',
            'proyectos.planos',
            'proyectos.ver',
            'proyectos.editar',
            'proyectos.eliminar',
            'proyectos.actividades.ver',
            'proyectos.actividades.crear',
            'proyectos.actividades.editar',
            'proyectos.actividades.eliminar',
            'proyectos.actividades.acciones',
            'proyectos.actividades.solicitudes',
            'proyectos.actividades.reportes',
            'proyectos.actividades.asistencias',
            'proyectos.actividades.reagendamientos',
            'proyectos.interventorias.view',
            'actividades.view',
        ]);

    }
}
