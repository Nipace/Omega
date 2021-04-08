<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Excel;


class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['role:Admin']);
    }

    public function index(User $model)
    {
        $user= User::paginate(4);
        return view('users.index', compact('user'));
    }

    public function create()
    {
        $role = Role::whereNotIn('name',['SuperAdmin'])->get();
        return view('users.create',compact('role'));
    }

    public function store(UserRequest $request)
    {
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->assignRole($request->role);
        $user->save();
        return redirect(route('user.index'))->withStatus(__('User Added successfully'));
    }
    public function show($id)
    {
        $user = User::find($id);
        $role = $user->getRoleNames();
        return view('users.view',compact('user','role'));
    }

    public function edit($id)
    {
        $allRole = Role::whereNotIn('name',['SuperAdmin'])->get();
        $user = User::find($id);
        $role = $user->roles->pluck('name');
        return view('users.edit',compact('user','role','allRole'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles($request->role);
        $user->save();
        return redirect(route('user.edit',$id))->withStatus('User sucessfully updated');
    }

    public function getImport()
    {
        return view ('users.userimport');
    }

    public function fileImport(Request $request) 
    {
       
        Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return back()->withStatus('User sucessfully uploaded');
    }

}
