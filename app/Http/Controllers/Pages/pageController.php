<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;

class pageController extends Controller
{
    //
    public function __construct()
    {
    }

    function homepage(){
        $post =Post::paginate(3);
        $hotnews = Post::first();
        $hotnews2 = Post::all()->skip(1)->take(3);
        return view('pages.index',['post'=>$post,'hotnews'=>$hotnews,'hotnews2'=>$hotnews2]);
    }

    function getLogin(){
        return view('pages.appcrud.login');
    }

    function postLogin(Request $request){
        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required'
            ],[
                'email.required' => 'Bạn chưa nhập Email',
                'password.required' => 'Bạn chưa nhập Password'
            ]);
        //Auth::attempt :  kiểm tra đăng nhập
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){

            return redirect('homepage');
        }else{
            return redirect('login')->with('notify','Đăng nhập không thành công :(');
        }
    }

    function getLogout(){
        Auth::logout();
        return redirect('homepage');
    }

    function getRegister(){
        return view('pages\appcrud\register');
    }

    function postRegister(Request $request){
        $this->validate($request,
            [
                'name' => "required",
                'email' =>'required|email|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ],[
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'password.required' =>'Bạn chưa nhập password',
                'confirm_password.required' =>'Bạn chưa nhập lại mật khẩu',
                'confirm_password.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->admin = 0;
        $user->save();

        return redirect('register')->with('notify','Đăng ký thành công !');
    }

    function getUserPersonal($id){
        $user = User::find($id);
        return view('pages.appcrud.edit',['user'=>$user]);
    }

    function postUserPersonal(Request $request,$id){
        $this->validate($request,
            [
                'name' => "required",
            ],[
                'name.required' => 'Bạn chưa nhập tên người dùng',
            ]);
        $user = User::find($id);
        $user->name = $request->name;

        if($request->changePassword == "on"){

            $this->validate($request,
                [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password'
                ],[
                    'password.required' =>'Bạn chưa nhập password',
                    'confirm_password.required' =>'Bạn chưa nhập lại mật khẩu',
                    'confirm_password.same' => 'Mật khẩu nhập lại chưa khớp'
                ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('user_personal/'.$id)->with('notify','Bạn đã sữa thành công');
    }

    function getDetail($id){
        $post = Post::find($id);
        return view('pages.detail',['post'=>$post]);
    }

    public function getForgotPassword(){
        return view('pages.appcrud.forgot_password');
    }

    public function postForgotPassword(Request $request){
        $input = $request->all();
        Mail::send('mailfb', array('name'=>$input["name"],'email'=>$input["email"], 'content'=>$input['comment']), function($message){
            $message->to('plachym.it@gmail.com', 'Visitor')->subject('Visitor Feedback!');
        });
        Session::flash('flash_message', 'Send message successfully!');

        return view('form');
    }




}
