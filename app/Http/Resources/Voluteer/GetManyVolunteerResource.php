<?php

namespace App\Http\Resources\Voluteer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetManyVolunteerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource = (object) $this->resource;

        return [
            'id' => $this?->id,
            'event_id' => $this?->event_id,
            'role' => ucwords(str_replace('_', ' ', $this?->role)),
            'name' => $this?->user?->full_name,
        ];
    }
}
