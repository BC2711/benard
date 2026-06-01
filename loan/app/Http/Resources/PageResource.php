<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'template' => $this->template,
            'featured_image' => $this->featured_image,
            'content' => $this->content ?? [],
            'seo' => $this->whenLoaded('seoMeta', fn () => $this->seoMeta),
            'sections' => PageSectionResource::collection($this->whenLoaded('publishedSections')),
            'updated_at' => $this->updated_at?->toAtomString(),
        ];
    }
}
