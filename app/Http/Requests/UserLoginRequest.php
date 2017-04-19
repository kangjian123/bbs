<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserLoginRequest extends Request
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
     * 用户登录规则
     * 用户名密码必须填
     * @return void
     */
    public function rules()
    {
        return [
            'username'=>'required',
            'password'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'username.required'=>'用户名必须填写',
        'password.required'=>'密码必须填写',
        ];
    }
}
