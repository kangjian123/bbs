<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request
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
     * 用户修改的规则
     * 昵称必须填写
     * 密码必须填写
     * 邮箱必须填写
     * 邮箱格式
     * @return void
     */
    public function rules()
    {
        return [
            'nickname'=>'required',
            'password'=>'required',
            'email'=>'required|regex:/\w+@\w+.["com","cn"]/',
        ];
    }

    public function messages()
    {
        return [
        'nickname.required'=>'昵称必须填写',
        'password.required'=>'密码必须填写',
        'email.required'=>'邮箱必须填写',
        'email.regex'=>'邮箱格式不正确',
        ];
    }
}
