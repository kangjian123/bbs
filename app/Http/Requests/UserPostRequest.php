<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserPostRequest extends Request
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
     * 用户注册的规则
     * 用户名必须填写
     * 用户名唯一
     * 昵称必须填写
     * 密码必须填写
     * 邮箱必须填写且格式需要正确
     * @return void
     */
    public function rules()
    {
        return [
            'username'=>'required|unique:user',
            'nickname'=>'required|unique:userdetail',
            'password'=>'required|regex:/^\w{6,18}$/',
            'email'=>'required|regex:/\w+@\w+.["com","cn"]/',
        ];
    }

    public function messages()
    {
        return [
        'username.required'=>'用户名必须填写',
        'username.unique'=>'用户名已存在!',
        'nickname.required'=>'昵称必须填写',
        'nickname.unique'=>'昵称已存在!',
        'password.required'=>'密码必须填写',
        'password.regex'=>'密码必须在6-18位之间的字母数字下划线',
        'email.required'=>'邮箱必须填写',
        'email.regex'=>'邮箱格式不正确',
        ];
    }
}
