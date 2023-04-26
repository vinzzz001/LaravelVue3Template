<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'content' => $this->content,
            'title' => $this->title,
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
            'assigned_to' => $this->assigned_to,

            'responses' => ResponseResource::collection($this->responses),
            'notes' => NoteResource::collection($this->notes->sortBy('created_at')) ,

            //Also helpfull.
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
