<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaUploadService
{
    public function store(UploadedFile $file, string $folder): string
    {
        $path = $file->store("cms/$folder", 'public');
        $this->optimizeImage($path, $file->getMimeType());

        Media::create([
            'disk' => 'public',
            'folder' => $folder,
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => Storage::disk('public')->size($path),
            'uploaded_by' => Auth::id(),
        ]);

        return Storage::disk('public')->url($path);
    }

    private function optimizeImage(string $path, ?string $mimeType): void
    {
        if (!in_array($mimeType, ['image/jpeg', 'image/png'], true) || !function_exists('imagecreatefromstring')) {
            return;
        }

        $disk = Storage::disk('public');
        $image = @imagecreatefromstring($disk->get($path));
        if (!$image) {
            return;
        }

        $temporary = tempnam(sys_get_temp_dir(), 'cms-image-');
        if ($mimeType === 'image/jpeg') {
            imagejpeg($image, $temporary, 82);
        } else {
            imagepng($image, $temporary, 7);
        }
        imagedestroy($image);

        $disk->put($path, file_get_contents($temporary));
        @unlink($temporary);
    }
}
