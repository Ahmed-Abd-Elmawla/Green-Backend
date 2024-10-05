<?php

namespace App\Http\Resources\Dashboard\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'image' => $this->image,
            // 'is_active' => (boolean) $this->is_active,
            // 'is_banned' => (boolean) $this->is_banned,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
