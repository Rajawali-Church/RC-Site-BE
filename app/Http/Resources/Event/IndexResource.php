<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
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
            'event_name' => $this?->name,
            'date' => $this?->date,
            'type' => $this?->type,
            'note' => $this?->note,
            'created_by' => $this?->createdBy,
            'created_at' => $this?->created_at,
            'update_at' => $this?->updated_at,
            'deleted_at' => $this?->deleted_at,
        ];
    }
}
