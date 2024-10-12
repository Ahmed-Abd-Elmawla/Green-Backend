<?php

namespace App\Http\Requests\Api\User\Invoices;

use App\Http\Requests\Api\Master;
use Illuminate\Validation\Rule;


class InvoiceRequest extends Master
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_type'      => 'required|string|in:cash,postpaid',
            'invoiceItems'      => 'required|array',
            'invoiceItems.*.product_id' => [
                'required',
                Rule::exists('products', 'uuid')
            ],
            'invoiceItems.*.quantity' => 'required|numeric',
            'invoiceItems.*.price' => 'required|numeric',
            'total_amount'      => 'required|numeric',
            'paid'      => 'nullable|numeric',
            'remaining'      => 'nullable|numeric',
            'client_id' => 'required|string|exists:clients,uuid',
        ];
    }
}
