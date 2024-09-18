<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Http\Requests\Api\Master;
use Illuminate\Validation\Rule;

class Login extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'         => 'required',
            'password'      => 'required|min:8',
            // 'device_token'  => 'nullable|string',
            // 'device_type'   => 'nullable|in:ios,android,hawaii,windows,mac,linux',
        ];
    }
}
