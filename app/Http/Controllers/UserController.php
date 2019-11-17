<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $rolesForAddUser = $this->userRepository->getRolesForAddUser();

        view()->share('rolesForAddUser', $rolesForAddUser);
    }

    function getAll()
    {
        $this->authorize('view-user');

        $user = $this->userRepository->getAll();

        return view('admin.users.index', ['user' => $user]);
    }

    function postAdd(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'same:password'
            ],[
                'name.required' =>'Bạn chưa nhập tên người dùng ',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' =>' Bạn chưa nhập đúng định dạng email',
                'email.unique' => ' Email đã tồn tại',
                'password.required' =>'Bạn chưa nhập password',
                'confirm_password.same' =>'Mật khẩu nhập lại chưa khớp'
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $this->userRepository->create_user($request);

        $user = $this->userRepository->getAll();

        return view('admin.users.row_user', compact('user'));

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

        return view('admin.users.row_user', compact('user'));
    }

    function postDelete(Request $request)
    {
        $user = $this->userRepository->find($request->id);

        $user->delete();

        $user = $this->userRepository->getAll();

        return view('admin.users.row_user', compact('user'));
    }

    public function getLoginAdmin()
    {
        $user = Auth::user();
        return view('admin.login.index', ['user' => $user]);
    }

    public function postLoginAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
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
