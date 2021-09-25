<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
            'base_id'=>'required',
            'class_title'=>'required|min:2|max:191',
            'class_label'=>'required|min:2|max:191'
        ];
    }

    public function messages()
    {
        return [
            'base_id.required'=>'پایه آموزشی الزامی می باشد!',
            'class_title.required'=>'عنوان کلاس الزامی می باشد!',
            'class_label.required'=>'لیبل کلاس الزامی می باشد!',
        ];
    }
}
