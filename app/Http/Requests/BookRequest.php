<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'educational_base_id'=>'required',
            'book_name'=>'required|min:2|max:191',
            'zarib'=>'required|digits_between:1,10|numeric',
            'nomreh_manfi'=>'required|digits_between:1,10|numeric',
            'nomreh'=>'required|digits_between:1,500|numeric',
        ];
    }

    public function messages()
    {
        return [
            'educational_base_id.required'=>'پایه آموزشی الزامی می باشد!',
            'book_name.required'=>'نام کتاب الزامی می باشد!',
            'zarib.required'=>'ضریب الزامی می باشد!',
            'nomreh_manfi.required'=>'تعداد غلط الزامی می باشد!',
            'nomreh.required'=>'نمره کتاب الزامی می باشد!',
        ];
    }
}
