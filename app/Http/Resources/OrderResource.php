<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_date' => $this->order_date,
            'total_items' => $this->total_items,
            'total_price' => $this->total_price,
            'orderDetails' => OrderDetailResource::collection($this->whenLoaded('orderDetails')),
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
