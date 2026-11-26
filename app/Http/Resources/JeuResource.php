<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class JeuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'game_name' => $this->nomJeu,
            'description' => $this->description,
            'price' => $this->prix,
            'published_at' => $this->published_at?->toISOString(),
            'image_rl' => $this->image_path 
                ? Storage::disk('public')->url($this->image_path) : null
        ];
    }
}
