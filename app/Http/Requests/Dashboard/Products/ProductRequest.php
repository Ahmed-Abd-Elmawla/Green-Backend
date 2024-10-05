<?php

namespace App\Http\Requests\Dashboard\Products;

use App\Http\Requests\Dashboard\Master;

class ProductRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier_id' => ['required', 'string', 'exists:suppliers,id'],
            'category_id' => ['required', 'string', 'exists:categories,id'],
            'name'     => ['required', 'string', 'min:2'],
            'desc'     => ['required', 'string', 'max:250'],
            'stock'    => ['required', 'numeric'],
            'price'    => ['required', 'numeric'],
            'offer'    => ['nullable', 'numeric'],
            'unit'     => ['required', 'string', 'in:liter,milliliter,package,carton'],
            'image'    => ['required', 'image', 'mimes:jpg,bmp,png,jpeg'],
        ];
    }
}
