<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    //
    function __construct()
    {
        $rolesForAddUser = Role::all()->where('title', '!=', 'root');;
        view()->share('rolesForAddUser', $rolesForAddUser);
    }

    function getAll()
    {
        $this->authorize('view-user');

        $user = User::all()->where('name', '!=', 'root');

        return view('admin.users.index', ['user' => $user]);
    }

    function postAdd(Request $request)
    {
        if (!empty($request->name) || empty($request->email) || empty($request->password) ||
            ($request->confirm_password != $request->password)) {
            return ['status' => 1, 'message' => 'Add user thất bại !!'];
        }
        $user = new User;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->admin = $request->admin;

        $user->save();

        return view('admin.users.row_user', [
            'u' => $user,
        ]);

    }

    function openEditModalUser(Request $request)
    {

        $data = $request->all();
        $id = $data['id'];
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    function postEdit(Request $request)
    {
        if ($request->password != $request->confirm_password) {
            return ['status' => 1, 'message' => 'confirm_password khác password !'];
        }
        $user = User::find($request->id);
        $user->name = $request->name;

        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return view('admin.users.row_user', [
            'u' => $user,
        ]);
    }

    function postDelete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return redirect('admin/users');
    }

    public function getLoginAdmin()
    {
        $user = Auth::user();
        return view('admin.login.index', ['user' => $user]);
    }

    public function postLoginAdmin(Request $request)
    {
        $this->validate($request, [
            'email' =>'required',
            'password' => 'required',
        ], [
            'email.required' => 'Bạn chưa nhập Email !',
            'password.required' => 'Bạn chưa nhập Password !'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect('admin');
        } else {
            return redirect('admin/login')->with('notify', 'Đăng nhập không thành công !!');
        }
    }

    public function getLogoutAdmin()
    {
        Auth::logout();
        return redirect('admin/login');
    }

}
