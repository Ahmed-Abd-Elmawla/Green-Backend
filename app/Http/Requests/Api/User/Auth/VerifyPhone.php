<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Http\Requests\Api\Master;
use App\Models\User;

class VerifyPhone extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'phone' => 'required|exists:users,phone',
            'otp' => 'required|numeric',
            'email' => [
                'required',
                // function($attribute, $value, $fail){
                //     if(!User::where('phone', $value)->exists()){
                //         $fail(__('api.auth.phone_number_not_exist'));
                //     }
                // }
            ],
        ];
    }
}
