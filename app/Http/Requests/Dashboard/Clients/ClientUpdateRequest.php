<?php

namespace App\Http\Requests\Dashboard\Clients;

use App\Http\Requests\Dashboard\Master;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => ['required', 'string', 'max:250', 'min:2'],
            'email'   => ['required', 'email', Rule::unique('clients', 'email')->ignore($this->route('client'))],
            'phone'   => ['required', 'numeric', Rule::unique('clients', 'phone')->ignore($this->route('client'))],
            'phone2'  => ['required', 'numeric', Rule::unique('clients', 'phone')->ignore($this->route('client'))],
            'address' => ['required', 'string', 'max:250', 'min:2'],
            // 'lat'     => ['nullable'],
            // 'long'    => ['nullable'],
        ];
    }
}
