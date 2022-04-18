<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionProfileController extends Controller
{
    private $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

        $this->middleware(['can:profiles']);
    }

    /******************************************************************************************************
     * Permissions
     ******************************************************************************************************/

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if(!$profile) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));

    }

    public function permissionsAvailable(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        if (!$request->permissions || count($request->permissions) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');

        }

        //dd($request->permissions);

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    /******************************************************************************************************
     * Profiles
     ******************************************************************************************************/


    public function profiles($idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('profiles', 'permission'));
    }

    public function profilesAvailable(Request $request, $idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $permission->profilesAvailable($request->filter);

        return view('admin.pages.permissions.profiles.available', compact('profiles', 'permission', 'filters'));
    }


    public function attachProfilesPermission(Request $request, $idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        if (!$request->profiles || count($request->profiles) == 0){
             return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um perfil');

        }

        //dd($request->permissions);

        $permission->profiles()->attach($request->profiles);

        return redirect()->route('permissions.profiles', $permission->id);
    }


    public function detachProfilePermission($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back();
        }

        $permission->profiles()->detach($profile);

        return redirect()->route('permissions.profiles', $profile->id);
    }




}
