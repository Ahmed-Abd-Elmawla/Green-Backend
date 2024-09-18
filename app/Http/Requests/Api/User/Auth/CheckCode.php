<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Http\Requests\Api\Master;

class CheckCode extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|exists:users,phone',
            'otp' => 'required'
        ];
    }
}
