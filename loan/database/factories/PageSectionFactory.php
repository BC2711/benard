<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageSectionFactory extends Factory
{
    protected $model = PageSection::class;

    public function definition(): array
    {
        return [
            'page_id' => Page::factory(),
            'name' => fake()->words(2, true),
            'section_key' => fake()->unique()->slug(2),
            'type' => 'custom',
            'status' => 'published',
            'content' => ['title' => fake()->sentence(), 'description' => fake()->paragraph()],
        ];
    }
}
