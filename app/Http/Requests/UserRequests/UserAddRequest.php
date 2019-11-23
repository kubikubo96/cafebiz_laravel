<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Support\Facades\Validator;

class UserAddRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'same:password'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên người dùng ',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => ' Bạn chưa nhập đúng định dạng email',
                'email.unique' => ' Email đã tồn tại',
                'password.required' => 'Bạn chưa nhập password',
                'confirm_password.same' => 'Mật khẩu nhập lại chưa khớp'
            ]
        );
    }
}
