<?php

namespace App\Http\Requests\Dashboard\Suppliers;

use App\Http\Requests\Dashboard\Master;

class SupplierRequest extends Master
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
            'email'    => ['nullable', 'email', 'unique:App\Models\Supplier,email'],
            'phone'    => ['nullable','numeric','unique:App\Models\Supplier,phone'],
            'address'  => ['required','string','min:2','max:255'],
            // 'location' => ['required','string','min:2','max:255'],
            // 'lat'     => ['nullable'],
            // 'long'    => ['nullable'],
        ];
    }
}
