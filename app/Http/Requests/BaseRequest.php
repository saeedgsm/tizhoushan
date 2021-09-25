<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
            'base_title'=>'required|min:2|max:191',
            'base_label'=>'required|min:2|max:191'
        ];
    }

    public function messages()
    {
        return [
            'base_title.required'=>'عنوان پایه الزامی می باشد!',
            'base_label.required'=>'لیبل پایه الزامی می باشد!',
        ];
    }
}
