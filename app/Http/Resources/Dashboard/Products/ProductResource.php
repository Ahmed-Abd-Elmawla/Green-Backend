<?php

namespace App\Http\Resources\Dashboard\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => $this->image,
            'stock' => $this->stock,
            'price' => $this->price,
            'offer' => $this->offer === 'false' ? __('dashboard.product.no_offers') : $this->offer,
            'unit' => $this->unit,
            // 'is_active' => (boolean) $this->is_active,
            'supplier_id' => $this->supplier_id,
            'category_id' => $this->category_id,
            'supplier' => $this->supplier,
            'category' => $this->category,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
