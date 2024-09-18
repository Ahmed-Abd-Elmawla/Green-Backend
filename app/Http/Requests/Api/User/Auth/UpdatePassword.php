<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Http\Requests\Api\Master;
use App\Models\User;

class UpdatePassword extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'phone'      => 'required|exists:users,phone',
            'email' => [
                'required',
                function($attribute, $value, $fail){
                    if(!User::where('email', $value)->exists()){
                        $fail(__('api.auth.provided_email_not_found'));
                    }
                }
            ],
            'otp' => 'required|string',
            'password'   => 'required|min:8|confirmed'
        ];
    }
}
