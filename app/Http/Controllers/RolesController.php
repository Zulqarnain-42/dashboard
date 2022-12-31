<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;

class RolesController extends Controller
{

    public function __construct(Role $role)
    {
        $this->middleware('auth');
        $this->role = $role;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of($this->role::all())->tojson();
        }
        return view('roles.index');
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.form')->with(compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles',
            'rolepermission' => 'required'
        ]);

        $role = $this->role->create([
            'name' => $request->name,
        ]);

        if($request->has('rolepermission')){
            $role->givePermissionTo($request->rolepermission);
        }

        return redirect()->route('roles.index')->with('Success');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $selectedpermission = $role->getAllPermissions();
        return view('roles.form')->with(compact('role','permissions'));
    }

    public function update(UpdateRoleRequest $request,Role $role)
    {
        $request->validate([
            'rolepermission' => 'required'
        ]);

        $role = $request->name;

        if($request->has('rolepermission')){
            $rolesPermission = $role->getPermissionNames();
            foreach($rolesPermission as $permission){
                $role->revokePermissionTo($permission);
            }
            $role->givePermissionTo($request->rolepermission);
        }

        $role->update();

        return redirect()->route('roles.index')->with('success');
    }
    public function destroy(Role $role)
    {
        Role::where('id',$role->id)->delete();
        return response()->json([
            'success' => 'Record Deleted Successfully!'
        ]);
    }

}
