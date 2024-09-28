<?php

namespace App\Http\Requests\Dashboard\User;

use App\Http\Requests\Dashboard\Master;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:250', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('user'))],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['required', 'numeric', Rule::unique('users', 'phone')->ignore($this->route('user'))],
            'image' => [
                'nullable',
                Rule::when($this->hasFile('image'), ['image', 'mimes:jpg,bmp,png,jpeg']),
            ],
        ];
    }
}
