<?php

namespace App\Http\Resources\Dashboard\Clients;

use App\Http\Resources\Dashboard\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'phone2' => $this->phone2,
            'address' => $this->address,
            // 'lat' => $this->lat,
            // 'long' => $this->long,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'user' => UserResource::make($this->user),
        ];
    }
}
