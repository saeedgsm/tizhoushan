<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterClassStudentRequest extends FormRequest
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
            'class_id'=>'required',
            'user_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'class_id.required'=>'کلاس آموزشی الزامی می باشد!',
            'user_id.required'=>'دانش آموز الزامی می باشد!',
        ];
    }
}
