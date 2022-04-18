<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionRoleController extends Controller
{
    private $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    /******************************************************************************************************
     * Permissions
     ******************************************************************************************************/

    public function permissions($idRole)
    {
        $role = $this->role->find($idRole);

        if(!$role) {
            return redirect()->back();
        }

        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions'));

    }

    public function permissionsAvailable(Request $request, $idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions', 'filters'));
    }

    public function attachPermissionsRole(Request $request, $idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        if (!$request->permissions || count($request->permissions) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');

        }

        //dd($request->permissions);

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.permissions', $role->id);
    }

    public function detachPermissionRole($idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back();
        }

        $role->permissions()->detach($permission);

        return redirect()->route('roles.permissions', $role->id);
    }

    /******************************************************************************************************
     * Roles
     ******************************************************************************************************/


    public function roles($idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $roles = $permission->roles()->paginate();

        return view('admin.pages.permissions.roles.roles', compact('roles', 'permission'));
    }

    public function rolesAvailable(Request $request, $idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $roles = $permission->rolesAvailable($request->filter);

        return view('admin.pages.permissions.roles.available', compact('roles', 'permission', 'filters'));
    }


    public function attachRolesPermission(Request $request, $idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        if (!$request->roles || count($request->roles) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um perfil');

        }

        //dd($request->permissions);

        $permission->roles()->attach($request->roles);

        return redirect()->route('permissions.roles', $permission->id);
    }


    public function detachRolePermission($idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back();
        }

        $permission->roles()->detach($role);

        return redirect()->route('permissions.roles', $role->id);
    }

}
