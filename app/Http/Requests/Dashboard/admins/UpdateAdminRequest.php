<?php

namespace App\Http\Requests\Dashboard\Admins;

use Illuminate\Validation\Rule;
use App\Http\Requests\Dashboard\Master;

class UpdateAdminRequest extends Master
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
            'email' => ['required', 'email', Rule::unique('admins', 'email')->ignore($this->route('admin'))],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['required', Rule::unique('admins', 'phone')->ignore($this->route('admin'))],
            'image' => [
                'nullable',
                Rule::when($this->hasFile('image'), ['image', 'mimes:jpg,bmp,png,jpeg']),
            ],
        ];
    }
}
