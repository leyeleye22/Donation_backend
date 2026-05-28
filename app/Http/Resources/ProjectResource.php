<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'theme' => $this->theme,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'beneficiary_label' => $this->beneficiary_label,
            'goal_amount' => $this->goal_amount,
            'collected_amount' => $this->collected_amount,
            'status' => $this->status,
            'cover_image' => $this->cover_image,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cover' => ProjectCoverResource::make($this->whenLoaded('cover')),
        ];
    }
}
