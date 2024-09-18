<?php

namespace App\Http\Resources\Api\User\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleUserResource extends JsonResource
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
            // 'type' => $this->type,
            'name' => $this->name,
            // 'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'referral_code' => $this->referral_code,
        ];
    }
}
