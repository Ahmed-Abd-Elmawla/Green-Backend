<?php

namespace App\Http\Resources\Dashboard\Clients;

use App\Http\Resources\Dashboard\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientMiniResource extends JsonResource
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
        ];
    }
}
