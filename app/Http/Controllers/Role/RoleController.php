<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        return view('role.index');
    }

    public function get(){
        return response()->json(['status' => true, 'roles' => Role::get()]);
    }

    public function getPermisos(){
        return response()->json(['status' => true, 'permisos' => Permission::get()]);
    }

    public function store(Request $request){
        $role = Role::create($request->all());
        return response()->json(['status' => true, 'role' => $role]);
    }

    public function storePermiso(Request $request){
        $permission = Permission::create($request->all());
        return response()->json(['status' => true, 'permiso' => $permission]);
    }

    public function storeRolePermisos(Request $request, Role $role){
        $role->syncPermissions($request->permisos);
        return response()->json(['status' => true]);
    }

    public function delete(Role $role){
        $role->delete();
        return response()->json(['status' => true]);
    }

    public function getRolePermisos(Role $role){
        return response()->json(['status' => true, 'permisos' => Permission::get(), 'active' => $role->permissions->pluck('name')]);
    }

    public function deletePermiso(Permission $permiso){
        $permiso->delete();
        return response()->json(['status' => true]);
    }

}
