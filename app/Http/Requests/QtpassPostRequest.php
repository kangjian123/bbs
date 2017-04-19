<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class QtpassPostRequest extends Request
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
            'ypass'=>'required',
            'password'=>'required',
            'surepassword'=>'required'
        ];
    }

    public function messages()
    {
        return [
        'ypass.required'=>'用户名必须填写',
        'password.required'=>'密码必须填写',
        'surepassword.required'=>'确认密码必须填写'
        ];
    }
}
