<?php

namespace App\Http\Requests\Dashboard\User;

use App\Http\Requests\Dashboard\Master;

class UserRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => ['required', 'string', 'min:2'],
            'email'    => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required','confirmed', 'string', 'min:8'],
            'phone'    => ['required','numeric','unique:App\Models\User,phone'],
            'image'    => ['required','image', 'mimes:jpg,bmp,png,jpeg'],
        ];
    }
}
