<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'product_category_id' => 'required',
                'product_name' => 'required|string|min:2|max:191',
                'product_latin' => 'required|string|min:2|max:191',
                'product_label' => 'required|string|min:2|max:191',
                'product_body' => 'required|string|min:10',
                'product_type' => 'required|in:physical,virtual',
                'product_type_payment' => 'required|in:cash,free',
                'product_price' => 'nullable|numeric',
                'product_image' => 'required|',
                'product_status' => 'required|',

            ];
        }

        return [
            'product_category_id' => 'required',
            'product_name' => 'required|string|min:2|max:191',
            'product_latin' => 'required|string|min:2|max:191',
            'product_label' => 'required|string|min:2|max:191',
            'product_body' => 'required|string|min:10',
            'product_type' => 'required|in:physical,virtual',
            'product_type_payment' => 'required|in:cash,free',
            'product_price' => 'nullable|numeric',
            'product_image' => 'nullable|',
            'product_status' => 'required|',

        ];

    }

}
