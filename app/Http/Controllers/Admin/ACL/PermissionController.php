<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }

    public function index()
    {
       $permissions = $this->repository->latest()->paginate();

       return view('admin.pages.permissions.index', [
           'permissions' => $permissions,
       ]);
    }

    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    public function store(StoreUpdatePermission $request)
    {
        //dd($request->all());

        $this->repository->create($request->all());

        return redirect()->route('permissions.index');
    }

    public function show($id)
    {
        $permission = $this->repository->where('id', $id)->first();

        if (!$permission)
            return redirect()->back();

       return view('admin.pages.permissions.show', [
           'permission' => $permission,
       ]);
    }

    public function destroy($id)
    {
        $permission = $this->repository
                            ->where('id', $id)
                            ->first();

        if (!$permission)
            return redirect()->back();

        $permission->delete();

        return redirect()->route('permissions.index');
    }

    public function search(Request $request)
    {
        // dd($request->all());

        $filters = $request->except('_token');

        $permissions = $this->repository->search($request->filter);

        return view('admin.pages.permissions.index', [
            'permissions' => $permissions,
            'filters' => $filters,
        ]);
    }

    public function edit($id)
    {
        $permission = $this->repository->where('id', $id)->first();

        if (!$permission)
            return redirect()->back();

       return view('admin.pages.permissions.edit', [
           'permission' => $permission,
       ]);
    }

    public function update(StoreUpdatePermission $request, $id)
    {
        $permission = $this->repository->where('id', $id)->first();

        if (!$permission)
            return redirect()->back();

        $permission->update($request->all());

        return redirect()->route('permissions.index');

    }


}
