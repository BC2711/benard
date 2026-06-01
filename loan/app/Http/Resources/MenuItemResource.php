<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'url' => $this->href,
            'target' => $this->target,
            'icon' => $this->icon,
            'children' => self::collection($this->whenLoaded('children')),
        ];
    }
}
