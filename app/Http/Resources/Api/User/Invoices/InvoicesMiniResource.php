<?php

namespace App\Http\Resources\Api\User\Invoices;

use App\Http\Resources\Api\User\Clients\ClientsMiniResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoicesMiniResource extends JsonResource
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
            'code' => $this->code,
            'payment_type' => $this->payment_type,
            'total_amount' => $this->total_amount,
            // 'paid' => $this->paid,
            // 'remaining' => $this->remaining,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'client' => new ClientsMiniResource($this->client),
        ];
    }
}
