<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    private $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;

        $this->middleware(['can:users']);
    }

    /******************************************************************************************************
     * Roles
     ******************************************************************************************************/

    public function roles($idUser)
    {
        $user = $this->user->find($idUser);

        if(!$user) {
            return redirect()->back();
        }

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', compact('user', 'roles'));

    }

    public function rolesAvailable(Request $request, $idUser)
    {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', compact('user', 'roles', 'filters'));
    }

    public function attachRolesUser(Request $request, $idUser)
    {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        if (!$request->roles || count($request->roles) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');

        }

        //dd($request->roles);

        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles', $user->id);
    }

    public function detachRoleUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if (!$user || !$role) {
            return redirect()->back();
        }

        $user->roles()->detach($role);

        return redirect()->route('users.roles', $user->id);
    }

    /******************************************************************************************************
     * Users
     ******************************************************************************************************/


    public function users($idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', compact('users', 'role'));
    }

    public function usersAvailable(Request $request, $idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $users = $role->usersAvailable($request->filter);

        return view('admin.pages.roles.users.available', compact('users', 'role', 'filters'));
    }


    public function attachUsersRole(Request $request, $idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        if (!$request->users || count($request->users) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um perfil');

        }

        //dd($request->roles);

        $role->users()->attach($request->users);

        return redirect()->route('roles.users', $role->id);
    }


    public function detachUserRole($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if (!$user || !$role) {
            return redirect()->back();
        }

        $role->users()->detach($user);

        return redirect()->route('roles.users', $user->id);
    }
}
