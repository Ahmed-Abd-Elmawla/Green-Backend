<?php

namespace App\Http\Requests\Api\User\Clients;

use App\Http\Requests\Api\Master;

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
            'phone2'   => ['nullable','numeric','unique:App\Models\Client,phone'],
            'address'  => ['required','string', 'min:2','max:250'],
            'lat'      => ['nullable', 'numeric'],
            'long'     => ['nullable', 'numeric'],
        ];
    }
}
