<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistPostRequest extends Request
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
            'username'=>'required|unique:user|regex:/[A-Za-z0-9_]{3,8}/',
            // 'nickname'=>'required|unique:userdetail',
            'email'=>'required|regex:/\w+@\w+.["com","cn"]/',
            'password'=>'required|regex:/[A-Za-z0-9_]{6,18}/',
            'surepassword'=>'required'
        ];
    }

    public function messages()
    {
        return [
        'username.required'=>'用户名必须填写',
        'username.unique'=>'用户名已存在!',
        'username.regex'=>'请输入3-8位用户名(字母、数字、下划线)',
        // 'nickname.required'=>'昵称必须填写',
        // 'nickname.unique'=>'昵称已存在!',
        'email.required'=>'邮箱必须填写',
        'email.regex'=>'邮箱格式不正确',
        'password.required'=>'密码必须填写',
        'password.regex'=>'密码格式不正确',
        'surepassword.required'=>'确认密码必须填写'
        ];
    }
}
