<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value,
            'start_at' => $this->start_date,
            'end_at' => $this->end_date,
            'status' => $this->status,
        ];
    }
}
