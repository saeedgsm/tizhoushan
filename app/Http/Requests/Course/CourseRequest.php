<?php

namespace App\Http\Requests\Course;

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
            'course_title' => 'required|string|min:2|max:50'
        ];
    }

    public function messages()
    {
        return [
            'course_title.required' => 'عنوان دوره الزامی می باشد!',
        ];
    }
}
