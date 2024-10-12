<?php

namespace App\Http\Resources\Dashboard\Invoices;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Http\Resources\Api\User\Clients\ClientsResource;
use App\Http\Resources\Api\User\Invoices\InvoicesProductsResource;

class InvoicesResource extends JsonResource
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
            'code' => $this->code,
            'payment_type' => $this->payment_type,
            'total_amount' => $this->total_amount,
            'paid' => $this->paid,
            'remaining' => $this->remaining,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'products' => InvoicesProductsResource::collection($this->products),
            'client' => new ClientsResource($this->client),
            'user' => UserResource::make($this->user),
        ];
    }
}
