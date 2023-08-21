<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
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
            'name' => $this->name,
            'apartmentId' => $this->apartment_id,
            'email' => $this->email,
            'contact' => $this->contact,
            'occupantsQty' => $this->occupantsQty,
            'startDate' => $this->start_date,
            'apartment' => ApartmentRelationResource::make($this->apartment)
        ];
    }
}
