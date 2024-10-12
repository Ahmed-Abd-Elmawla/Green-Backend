<?php

namespace App\Http\Resources\Dashboard\Collections;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Http\Resources\Api\User\Clients\ClientsResource;
use App\Http\Resources\Api\User\Invoices\InvoicesProductsResource;

class CollectionsResource extends JsonResource
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
            'amount' => $this->amount,
            'desc' => $this->desc,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'client' => new ClientsResource($this->client),
            'user' => UserResource::make($this->user),
        ];
    }
}
