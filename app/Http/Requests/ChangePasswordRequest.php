<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest {

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
            'old_password' => 'required',
            'password' => 'required|min:6',
            'retype_password' => 'required|same:password',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            $user = Auth()->guard('frontend')->user();
            if (!Hash::check($this->old_password, $user->password))
                $validator->errors()->add('old_password', 'Old password is incorrect.');
        });
    }

}
