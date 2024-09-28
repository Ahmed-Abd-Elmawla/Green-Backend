<?php

namespace App\Http\Requests\Dashboard\Admins;

use App\Http\Requests\Dashboard\Master;

class AddAdminRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'min:2'],
            'email'    => ['required', 'email', 'unique:App\Models\Admin,email'],
            'password' => ['required','confirmed', 'string', 'min:8'],
            'phone'    => ['required','numeric','unique:App\Models\Admin,phone'],
            'image'    => ['required','image', 'mimes:jpg,bmp,png,jpeg'],
        ];
    }
}
