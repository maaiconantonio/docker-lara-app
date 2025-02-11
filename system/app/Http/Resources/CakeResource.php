<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CakeResource extends JsonResource
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
            'description' => $this->description,
            'weight' => $this->weight,
            'price' => $this->price,
            'qty_avail' => $this->qty_avail,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
