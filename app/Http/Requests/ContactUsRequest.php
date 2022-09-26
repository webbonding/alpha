<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'message' => 'required'
        ];
    }
    public function withValidator($validator) {
        $validator->after(function ($validator) {
            if($this->name=='Type Your Name...'){
                $validator->errors()->add('name', 'Name field is required.');
            }
            if($this->phone=='Type Your Contact No...'){
                $validator->errors()->add('phone', 'Phone field is required.');
            }
            if($this->email=='Type Your Email...'){
                $validator->errors()->add('email', 'Email field is required.');
            }
            if($this->message=='Type Your Message...'){
                $validator->errors()->add('message', 'Message field is required.');
            }
            
        });
    }

}
