<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
                'block' => 'required',
                'email' => 'required|min:2|max:191|email|unique:users',
                'phone' => 'required|digits:11|numeric|unique:users',
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ];
        }

        return [
            'first_name' => 'required|min:2|max:90',
            'last_name' => 'required|min:2|max:90',
            'block' => 'required',
            'email' => 'nullable|min:2|max:191|email|unique:users',
            'phone' => 'nullable|digits:11|numeric|unique:users',
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];

    }
}
