<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use App\Http\Requests\UserRequests\UserAddRequest;

class UserController extends Controller
{

    protected $userRepository;
    protected $userAddRequest;

    function __construct(UserRepository $userRepository, UserAddRequest $userAddRequest)
    {
        $this->userRepository = $userRepository;
        $this->userAddRequest = $userAddRequest;

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
        $validator = $this->userAddRequest->rules($request);

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
        if (empty($request->name) || ($request->password != $request->confirm_password)) {
            return ['status' => 1, 'message' => 'Edit thất bại! '];
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
