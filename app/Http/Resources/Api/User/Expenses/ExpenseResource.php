<?php

namespace App\Http\Resources\Api\User\Expenses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'amount' => $this->amount,
            'desc' => $this->desc,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
