<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Requests\Api\Master;

class Register extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:100',
            'phone'       => [
                "required",
                // "numeric",
                // "digits:10",
                // function ($attribute, $value, $fail) {
                //     // Check if the phone number exists in either the users or drivers table
                //     if (User::where('phone', $value)->whereNotNull('deleted_at')->exists()) {
                //         $fail("The $attribute has already been taken.");
                //     }
                // }
                Rule::unique('users')->whereNull('deleted_at'),
            ],

            'email'         => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password'      => 'required|min:8|confirmed',

            'address'       => 'required|string',

            'image'        => 'nullable|file|mimes:png,jpg,jpeg',

            'device_token'  => 'nullable|string|required_with:device_type',
            'device_type'   => 'nullable|in:ios,android,hawaii,windows,mac,linux|required_with:device_token',
        ];
    }
}
