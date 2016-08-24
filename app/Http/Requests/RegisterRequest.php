<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username|regex:/^[\w]+$/',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'name' => 'required',
            'email' => 'required|email'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Bắt buộc nhập tên đăng nhập!',
            'username.unique' => 'Tên đăng nhập đã tồn tại!',
            'username.regex' => 'Tên đăng nhập chỉ được chứa dấu gạch dưới, các chữ số và các kí tự a-z, A-Z',
            'password.required' => 'Bắt buộc nhập mật khẩu!',
            'repassword.required' => 'Bắt buộc nhập xác nhận mật khẩu!',
            'repassword.same' => 'Mật khẩu xác nhận không trùng khớp!',
            'name.required' => 'Bắt buộc nhập họ tên!',
            'email.required' => 'Bắt buộc nhập email!',
            'email.email' => 'Email không đúng định dạng'
        ];
    }
}
