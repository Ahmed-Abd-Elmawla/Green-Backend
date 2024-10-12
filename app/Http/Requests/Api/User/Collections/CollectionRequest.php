<?php

namespace App\Http\Requests\Api\User\Collections;

use App\Http\Requests\Api\Master;
use Illuminate\Validation\Rule;


class CollectionRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required|string|exists:clients,uuid',
            'amount'      => 'required|numeric',
            'desc'      => 'required|string|max:250',
        ];
    }
}
