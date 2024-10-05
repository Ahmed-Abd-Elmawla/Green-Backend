<?php

namespace App\Http\Requests\Dashboard\Clients;

use App\Http\Requests\Dashboard\Master;

class ClientRequest extends Master
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
            'email'    => ['required', 'email', 'unique:App\Models\Client,email'],
            'phone'    => ['required','numeric','unique:App\Models\Client,phone'],
            'phone2'    => ['nullable','numeric','unique:App\Models\Client,phone2'],
            'address'    => ['required','string','min:2','max:255'],
            'lat'     => ['nullable'],
            'long'    => ['nullable'],
        ];
    }
}
