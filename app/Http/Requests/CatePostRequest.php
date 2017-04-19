<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class CatePostRequest extends Request
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
            'tname'=>'required',
            'tcontent'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'tname.required'=>'板块名必须填写',
        'tcontent.required'=>'板块介绍必须填写',
        ];
    }
}
