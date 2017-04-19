<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class PicPostRequest extends Request
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
        return[
            'photo'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'photo.required'=>'请添加图片'
        ];
    }
}
