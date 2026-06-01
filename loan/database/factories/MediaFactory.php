<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'disk' => 'public',
            'folder' => 'general',
            'path' => 'cms/general/' . fake()->uuid() . '.jpg',
            'name' => fake()->words(2, true) . '.jpg',
            'mime_type' => 'image/jpeg',
            'size' => fake()->numberBetween(1024, 204800),
        ];
    }
}
