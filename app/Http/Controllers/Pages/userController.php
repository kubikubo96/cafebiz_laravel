<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\postModel;
use App\Models\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    //
    function getAll()
    {

        $user = userModel::all();
        return view('admin.users.index', ['user' => $user]);
    }

    function getAdd()
    {
        return view('admin.users.add');
    }

    function postAdd(Request $request)
    {

//        $this->validate($request,
//            [
//                'name' => "required",
//                'email' => 'required|email|unique:users,email',
//                'password' => 'required',
//                'confirm_password' => 'required|same:password'
//            ], $error_add =[
//                'name.required' => 'Bạn chưa nhập tên người dùng',
//                'email.required' => 'Bạn chưa nhập email',
//                'email.email' => 'Bạn chưa nhập đúng định dạng email',
//                'email.unique' => 'Email đã tồn tại',
//                'password.required' => 'Bạn chưa nhập password',
//                'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu',
//                'confirm_password.same' => 'Mật khẩu nhập lại chưa khớp'
//            ]);
//        $name = $request->name;
//        if(empty($name)) {
//            return ['status' => 0, 'message' => 'Bạn chưa nhập tên'];
//        }
        if(empty($request->name) || empty($request->email) || empty($request->password) || ($request->confirm_password != $request->password)){
            return ['status' => 0,'message' =>'Add user thất bại !!'];
        }
        $user = new userModel;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->admin = $request->admin;

        $user->save();

        echo "Add thành công  !";

//        return redirect('admin/users/add')->with('notify',"Bạn đã thêm mới thành công !!!");

    }

    function getEdit($id)
    {
        $user = userModel::find($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => "required",
            ], [
                'name.required' => 'Bạn chưa nhập tên người dùng',
            ]);
        $user = userModel::find($id);
        $user->name = $request->name;

        if ($request->changePassword == "on") {

            $this->validate($request,
                [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password'
                ], [
                    'password.required' => 'Bạn chưa nhập password',
                    'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu',
                    'confirm_password.same' => 'Mật khẩu nhập lại chưa khớp'
                ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('admin/users/edit/' . $id)->with('notify', 'Bạn đã sữa thành công');
    }

    function getDelete($id)
    {
        $user = userModel::find($id);
        $user->delete();

        return redirect('admin/users')->with('notify', 'Delete thành công !');
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
            'password' => 'required'
        ], [
            'email.required' => 'Bạn chưa nhập Email',
            'password.required' => 'Bạn chưa nhập Password'
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
