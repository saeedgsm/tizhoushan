<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PorseshnamehRequest extends FormRequest
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
            'key' => 'required',
            'number_of_question' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'key.required'=>'کلید سوال الزامی می باشد!',
            'number_of_question.required'=>'شماره سوال الزامی می باشد!',
        ];
    }
}
