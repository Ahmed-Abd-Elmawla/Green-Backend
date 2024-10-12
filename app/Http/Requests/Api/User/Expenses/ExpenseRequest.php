<?php

namespace App\Http\Requests\Api\User\Expenses;

use App\Http\Requests\Api\Master;


class ExpenseRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'      => 'required|numeric',
            'desc'      => 'required|string|max:250',
        ];
    }
}
