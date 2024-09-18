<?php

namespace App\Http\Resources\Api\User\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image,
            'address' => $this->address,
            // 'is_active' => (boolean) $this->is_active,
            // 'is_banned' => (boolean) $this->is_banned,
            // 'allow_notify' => (boolean) $this->allow_notify,
            'token' => $this->when($this->token, $this->token, auth('user')->tokenById($this->id)),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
