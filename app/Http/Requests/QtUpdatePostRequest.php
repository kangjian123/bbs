<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Session;
class QtUpdatePostRequest extends Request
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
        $uid = session('uid');
        return [
            'nickname' => 'required|unique:userdetail,nickname,'.$uid['id'].',uid|regex:/\S{3,8}/',
            // 'nickname'=>'required|unique:userdetail,uid,'.$uid['id'].'',
            'qq'=>'unique:userdetail,qq,'.$uid['id'].',uid|regex:/^\d[0-9]{5,12}$/',
            'email'=>'required|unique:userdetail,email,'.$uid['id'].',uid|regex:/\w+@\w+.["com","cn"]/',
        ];
    }

    public function messages()
    {
        return [
        'nickname.required'=>'昵称必须填写',
        'nickname.unique'=>'昵称已存在!',
        'nickname.regex'=>'请输入3-8位不含特殊字符的用户名',
        'qq.regex'=>'该QQ不合法',
        'qq.unique'=>'该QQ已绑定',
        'email.required'=>'邮箱必须填写',
        'email.regex'=>'邮箱格式不正确',
        'email.unique'=>'该邮箱已绑定',
        ];
    }
}
