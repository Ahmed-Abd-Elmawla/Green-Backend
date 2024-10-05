<?php

namespace App\Http\Requests\Dashboard\Categories;

use App\Http\Requests\Dashboard\Master;

class CategoryRequest extends Master
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
        ];
    }
}
