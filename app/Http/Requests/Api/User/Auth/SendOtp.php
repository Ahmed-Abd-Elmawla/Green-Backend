<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Models\User;
use App\Http\Requests\Api\Master;
use Illuminate\Foundation\Http\FormRequest;

class SendOtp extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                // function ($attribute, $value, $fail) {
                //     if (!User::where('email', $value)->exists()) {
                //         $fail(__('api.auth.email_not_exist'));
                //     }
                // }
            ]
        ];
    }
}
