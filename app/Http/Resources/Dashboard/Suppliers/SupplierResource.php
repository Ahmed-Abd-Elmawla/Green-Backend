<?php

namespace App\Http\Resources\Dashboard\Suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            // 'location' => $this->location,
            // 'lat' => $this->lat,
            // 'long' => $this->long,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
