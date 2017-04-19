<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdAddRequest extends Request
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
            'adname'=>'required',
            'adlink'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'adname.required'=>'广告名称必须填写',
        'adlink.required'=>'广告地址必须填写',
        ];
    }
}
