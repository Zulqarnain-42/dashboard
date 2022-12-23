<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Status;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\Profile\ChangePasswordRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            // $users = User::with('roles')->get();
            // $users->transform(function($user){
            //     $user->role = $user->getRoleNames()->first();
            // });
            return datatables()->of(User::with('roles')->get())->tojson();
        }
        return view('users.index');
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

        if($request->ProfileFilePond){
            $newfilename = Str::after($request->ProfileFilePond,'tmp/');
            Storage::disk('public')->move($request->ProfileFilePond,"images/user/$newfilename");
            $user->image = "storage/images/user/$newfilename";
        }

        if($request->has('userpermissions')){
            $user->givePermissionTo($request->userpermissions);
        }

        $user->save();
        return redirect()->route('users.index')->with('Success');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $collectionstatus = Status::get();
        return view('users.form')->with(compact('user','roles','permissions','collectionstatus'));
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
        if($request->has('role')){
            $userRole = $user->getRoleNames();
            foreach($userRole as $role){
                $user->removeRole($role);
            }

            $user->assignRole($request->role);
        }

        if($request->has('userpermissions')){
            $userPermission = $user->getPermissionNames();
            foreach($userPermission as $permission){
                $user->revokePermissionTo($permission);
            }
            $user->givePermissionTo($request->userpermissions);
        }

        $user->update();
        return redirect()->route('users.index')->with('success');
    }

    public function destroy(User $user)
    {
        if($user->status === 1){
            User::where('id',$user->id)->update(['status'=> 0]);
            return back();
        }else{
            User::where('id',$user->id)->update(['status'=> 1]);
            return back();
        }
    }

    public function uploadprofile(Request $request)
    {
        if($request->ProfileFilePond){
            $path = $request->file('ProfileFilePond')->store('tmp','public');
        }
        return $path;
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validate([
            'newpassword'=>'required|min:6|max:30|confirmed'
        ]);

        $user = auth()->user();

        $user->password = $request->newpassword;
        $user->update();

        return redirect()->back()->with('success');
    }
}
