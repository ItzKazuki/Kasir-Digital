<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'full_name' => $this->full_name,
            'phone_number' => $this->no_telp,
            'points' => $this->point,
            'email' => $this->email,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];
    }
}
