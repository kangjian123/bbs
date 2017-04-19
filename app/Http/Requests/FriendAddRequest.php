<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class FriendAddRequest extends Request
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
            'fname'=>'required',
            'flink'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'fname.required'=>'链接名称必须填写',
        'flink.required'=>'链接地址必须填写',
        ];
    }
}
