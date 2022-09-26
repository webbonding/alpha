<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'photo' => 'nullable|mimes:jpg,jpeg,png',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'net_weight' => 'required',
            'brand' => 'required',
            'status' => 'required'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            
        });
    }

}
