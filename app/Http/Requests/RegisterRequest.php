<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\UserMaster;

class RegisterRequest extends FormRequest {

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
            'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|min:8|max:20',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $checkUser = UserMaster::where('email', $this->email)->where('status','1')->count();
            if ($checkUser > 0)
                $validator->errors()->add('email', 'Email already in use.');
            
        });
    }

}
