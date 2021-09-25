<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        if ($this->method() == 'POST'){
            return [
                'first_name' => 'required|min:2|max:90',
                'last_name' => 'required|min:2|max:90',
                'block' => 'nullable',
                'email' => 'nullable|min:2|max:191|email|unique:users',
                'phone' => 'nullable|digits:11|numeric|unique:users',
                'password' => ['required', 'string', 'min:4', 'confirmed'],

                'melli' => ['nullable', 'numeric', 'digits:10', 'unique:info_students'],
                'father' => 'nullable|min:2|max:90',
                'gender' => 'nullable',
            ];
        }

        return [
            'first_name' => 'required|min:2|max:90',
            'last_name' => 'required|min:2|max:90',
            'block' => 'nullable',
            'email' => 'nullable|min:2|max:191|email|unique:users',
            'phone' => 'nullable|digits:11|numeric|unique:users',
            'password' => ['nullable', 'string', 'min:4', 'confirmed'],

            'melli' => ['nullable', 'numeric', 'digits:10', 'unique:info_students'],
            'father' => 'nullable|min:2|max:90',
            'gender' => 'nullable',
        ];

    }

}
