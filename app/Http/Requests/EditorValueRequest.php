<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditorValueRequest extends Request
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
            'editorValue'=>'required|regex:/^([^\s])/',
        ];
    }

    public function messages()
    {
        return [
        'editorValue.required'=>'帖子内容不能为空',
        'editorValue.regex'=>'帖子内容不能为空',
        ];
    }
}
