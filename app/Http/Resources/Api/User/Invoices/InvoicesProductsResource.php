<?php

namespace App\Http\Resources\Api\User\Invoices;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoicesProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => $this->image,
            'quantity' => (int)$this->pivot->quantity,
            'unit' => $this->unit,
            'price' => $this->pivot->price,
        ];
    }
}
