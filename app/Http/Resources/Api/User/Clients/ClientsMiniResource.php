<?php

namespace App\Http\Resources\Api\User\Clients;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientsMiniResource extends JsonResource
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
            // 'email' => $this->email,
            // 'phone' => $this->phone,
            // 'phone2' => $this->phone2,
            // 'address' => $this->address,
            // 'lat' => $this->lat,
            // 'long' => $this->long,
            // 'dues' => $this->dues,
            // 'balance' => $this->balance,
            // 'net_account' => $this->net_account,
            // 'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
