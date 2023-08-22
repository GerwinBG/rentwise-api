<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
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
            'unit' => $this->unit,
            'address' => $this->address,
            'description' => $this->description,
            'price' => $this->price,
            'userId' => $this->user_id,
            'tenant' => TenantResource::make($this->tenant)
        ];
    }
}
