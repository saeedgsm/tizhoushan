<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AzmoonRequest extends FormRequest
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
            'book_id' => 'required',
            'azmoon_type' => 'required|in:normal,advanced',
            'azmoon_title' => 'required|min:2|max:90',
            'start_date' => 'required|',
            'end_date' => 'required|',
            'azmoon_time' => 'required|',
            'type_payment' => 'required|',
            'azmoon_sync_time' => 'nullable|numeric',

            'price' => 'nullable|numeric',
            'type' => 'required|',
            'soal_count' => 'required|',
            'answer_type' => 'required|',
            'soal_cover' => 'nullable|',
        ];
    }

    public function messages()
    {
        return [
            'book_id.required'=>'کتاب الزامی می باشد!',
            'azmoon_type.required'=>'نوع آزمون الزامی می باشد!',
            'type.required'=>'نوع سوالات الزامی می باشد!',
            'azmoon_title.required'=>'عنوان آزمون الزامی می باشد!',
            'soal_count.required'=>'تعداد سوال الزامی می باشد!',
            'answer_type.required'=>'نوع نمایش گزینه الزامی می باشد!',
            'price.required'=>'هزینه دوره الزامی می باشد!',
            'start_date.required'=>'تاریخ شروع الزامی می باشد!',
            'end_date.required'=>'تاریخ پایان الزامی می باشد!',
            'soal_cover.required'=>'کاور آزمون الزامی می باشد!',
            'type_payment.required'=>'نوع هزینه الزامی می باشد!',
            'azmoon_sync_time.numeric'=>'مدت زمان تاخیر را به عدد وارد کنید!',
        ];
    }
}
