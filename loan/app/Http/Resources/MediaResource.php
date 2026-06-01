<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'folder' => $this->folder,
            'name' => $this->name,
            'url' => $this->url ?: Storage::disk($this->disk)->url($this->path),
            'alt_text' => $this->alt_text,
            'caption' => $this->caption,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
        ];
    }
}
