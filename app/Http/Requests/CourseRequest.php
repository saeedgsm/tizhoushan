<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'course_title'=>'required|max:191'
        ];
    }

    public function messages()
    {
        return [
            'course_title.required'=>'عنوان دوره الزامی می باشد!',
        ];
    }

}
