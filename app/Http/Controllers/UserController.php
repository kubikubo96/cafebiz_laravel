<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{

    protected $userRepository;

    function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;

        $rolesForAddUser = Role::all()->where('title', '!=', 'root');

        view()->share('rolesForAddUser', $rolesForAddUser);
    }

    function getAll()
    {
        $this->authorize('view-user');

        $user = $this->userRepository->getAll()->where('name', '!=', 'root');

        return view('admin.users.index', ['user' => $user]);
    }

    function postAdd(Request $request)
    {
        if ( empty($request->name) || empty($request->email) || empty($request->password) ||
            ($request->confirm_password != $request->password)) {
            return ['status' => 1, 'message' => 'Add user thất bại !!'];
        }
        $this->userRepository->create_user($request);

        $user = $this->userRepository->getAll();

        return view('admin.users.row_user',compact('user'));

    }

    function openEditModalUser(Request $request)
    {
        $user = $this->userRepository->openEditModal_user($request);

        return view('admin.users.edit', compact('user'));
    }

    function postEdit(Request $request)
    {
        if ($request->password != $request->confirm_password) {
            return ['status' => 1, 'message' => 'confirm_password khác password !'];
        }
        $this->userRepository->userEditRepo($request);

        $user = $this->userRepository->getAll();

        return view('admin.users.row_user',compact('user'));
    }

    function postDelete(Request $request)
    {
        $user = $this->userRepository->find($request->id);
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
