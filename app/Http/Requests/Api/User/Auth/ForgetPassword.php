<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Http\Requests\Api\Master;
use App\Models\Driver;
use App\Models\User;

class ForgetPassword extends Master
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

            'phone' => [
                "required",
                function ($attribute, $value, $fail) {
                    // Check if the phone number not exists in either the users table
                    if (!User::where('phone', $value)->exists() ) {
                        $fail(__('api.auth.phone_number_not_exist'));
                    }
                }
            ]
        ];
    }
}
