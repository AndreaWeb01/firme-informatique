<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        // $roles = Role::all();
        $roles = Role::with('permissions')->paginate(15);
        return view('administration.role-permission.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('administration.role-permission.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array', // les permissions doivent être un tableau
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web', // important si non défini dans modèle
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('status', 'Role enregistré avec succès');
    }


    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('administration.role-permission.roles.edit', compact("role", "permissions"));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'permissions' => 'array|required', // les permissions doivent être un tableau
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('status','Role modifié avec succès');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect()->route('roles.index')->with('status','Role supprimé avec succès');
    }

    // public function addPermissionToRole($roleId)
    // {
    //     $permissions = Permission::get();
    //     $role = Role::findOrFail($roleId);
    //     $rolePermissions = DB::table('role_has_permissions')
    //                             ->where('role_has_permissions.role_id', $role->id)
    //                             ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //                             ->all();

    //     return view('administration.role-permission.roles.add-permissions', [
    //         'role' => $role,
    //         'permissions' => $permissions,
    //         'rolePermissions' => $rolePermissions
    //     ]);
    // }

    // public function givePermissionToRole(Request $request, $roleId)
    // {
    //     $request->validate([
    //         'permission' => 'required'
    //     ]);

    //     $role = Role::findOrFail($roleId);
    //     $role->syncPermissions($request->permission);

    //     return redirect()->route('roles.index')->with('status','Autorisations ajoutées au rôle');
    // }
}
