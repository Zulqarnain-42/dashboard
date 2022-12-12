<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Status;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            return $user;
        });
        return view('users.index')->with(compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $collectionstatus = Status::get();
        return view('users.form')->with(compact('roles','permissions','collectionstatus'));
    }

    public function store(StoreUserRequest $request)
    {

        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->designation = $request->designation;
        $user->status = $request->status;
        $user->assignRole($request->role);

        if($request->has('permissions')){
            $user->givePermissionTo($request->permissions);
        }

        $user->save();
    }

    public function edit(User $user)
    {
        return view('users.form')->with(compact('user'));
    }

    public function update(UpdateUserRequest $request,User $user)
    {
         $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->designation = $request->designation;
        $user->status = $request->status;
        $user->assignRole($request->role);

        if($request->has('permissions')){
            $user->givePermissionTo($request->permissions);
        }

        $user->update();
    }

    public function destroy(User $user)
    {
        User::where('id',$user->id)->delete();
        return back();
    }
}
