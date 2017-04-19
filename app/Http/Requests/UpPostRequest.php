<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpPostRequest extends Request
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
            'username'=>'required',
            // 'nickname'=>'required|unique:userdetail',
            // 'email'=>'required|regex:/\w+@\w+.["com","cn"]/',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
        'username.required'=>'用户名必须填写',
        // 'username.unique'=>'用户名已存在!',
        // 'nickname.required'=>'昵称必须填写',
        // 'nickname.unique'=>'昵称已存在!',
        // 'email.required'=>'邮箱必须填写',
        // 'email.regex'=>'邮箱格式不正确',
        'password.required'=>'密码必须填写'
        ];
    }
}
