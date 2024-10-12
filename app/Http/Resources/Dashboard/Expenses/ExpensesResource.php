<?php

namespace App\Http\Resources\Dashboard\Expenses;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\User\UserResource;

class ExpensesResource extends JsonResource
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
            'user' => UserResource::make($this->user),
        ];
    }
}
