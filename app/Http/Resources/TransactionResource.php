<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'discount_total' => $this->discount_total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'cash' => $this->cash,
            'cash_change' => $this->cash_change,
            'point_usage' => $this->point_usage,
            'order' => new OrderResource($this->whenLoaded('order')),
            'member' => new MemberResource($this->whenLoaded('member')),
        ];
    }
}
