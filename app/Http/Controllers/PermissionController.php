<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use Spatie\Permission\Models\Permission;
use Auth;

class PermissionController extends Controller
{

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = $this->permission::all();
        return view('permissions.index')->with(compact('permissions'));
    }

    public function create()
    {
        return view('permissions.form');
    }

    public function store(StorePermissionRequest $request)
    {
        $request->validate([
            'permissionname' => 'required',
            'permissionurl' => 'required'
        ]);

        $this->permission->create([
            'name' => $request->permissionname,
            'url' => $request->permissionurl,
            'userid' => Auth()->user()->id
        ]);

        return redirect()->route('permissions.index')->with('Success');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.form')->with(compact('permission'));
    }

    public function update(UpdatePermissionRequest $request,Permission $permission)
    {
        dd($request);
    }

    public function destroy(Permission $permission)
    {
        Permission::where('id',$permission->id)->delete();
        return back();
    }
}
