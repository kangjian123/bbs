<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class CardUpdateRequest extends Request
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
            'ptitle'=>'required',
            'pcontent'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'ptitle.required'=>'标题必须填写',
        'pcontent.required'=>'内容必须填写',
        ];
    }
}
