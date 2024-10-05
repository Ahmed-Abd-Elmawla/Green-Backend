<?php

namespace App\Http\Resources\Api\User\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'image' => $this->image,
            'desc' => $this->desc,
            'stock' => (float)$this->stock,
            'unit' => $this->unit,
            'price' => (float)$this->price,
            'offer' => (float)$this->offer,
        ];
    }
}
