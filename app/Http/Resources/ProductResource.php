<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'barcode' => $this->barcode,
            'name' => $this->name,
            'price' => $this->price == 0 ? 'FREE' : $this->price,
            'stock' => $this->stock,
            'expired_at' => $this->expired_at,
            'image' => $this->image_url,
            'description' => $this->description,
        ];
    }
}
