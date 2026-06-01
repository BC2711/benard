<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageSectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'key' => $this->section_key,
            'type' => $this->type,
            'component' => $this->component,
            'order' => $this->sort_order,
            'content' => $this->content ?? [],
            'settings' => $this->settings ?? [],
        ];
    }
}
