<?php

namespace App\Http\Requests\Dashboard\Suppliers;

use App\Http\Requests\Dashboard\Master;
use Illuminate\Validation\Rule;

class SupplierUpdateRequest extends Master
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
            'email'   => ['nullable', 'email', Rule::unique('suppliers', 'email')->ignore($this->route('supplier'))],
            'phone'   => ['nullable', 'numeric', Rule::unique('suppliers', 'phone')->ignore($this->route('supplier'))],
            'address' => ['required', 'string', 'max:250', 'min:2'],
            // 'location' => ['required', 'string', 'max:250', 'min:2'],
            // 'lat'     => ['nullable'],
            // 'long'    => ['nullable'],
        ];
    }
}
