<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookSearchResource extends JsonResource
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
            'publisher' => $this->publisher->name,
            'title' => $this->title,
            'summary' => $this->summary,
            'authors' => $this->authors->pluck('name')->toArray()
        ];
    }
}
