<?php

namespace App\Http\Resources\Api\User\AccountStatement;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountStatementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return [
        //     'id' => $this->uuid,
        //     'created_at' => $this->created_at->format('Y-m-d'),
        //     'credit' => $this->amount,
        //     'debit ' => 0,
        //     'type' => __('api.collection'),
        // ];

        if ($this->resource instanceof \App\Models\Invoice) {
            return [
                'id'         => $this->uuid,
                'created_at' => $this->created_at->format('Y-m-d'),
                'credit'     => (float) $this->paid ? : (float) $this->total_amount,
                'debit'      => (float) $this->remaining,
                'type'       => __('api.invoice.invoice'),
            ];
        } elseif ($this->resource instanceof \App\Models\Collection) {
            return [
                'id'         => $this->uuid,
                'created_at' => $this->created_at->format('Y-m-d'),
                'credit'     => (float) $this->amount,
                'debit'      => 0,
                'type'       => __('api.collection'),
            ];
        }

        return [];
    }
}
