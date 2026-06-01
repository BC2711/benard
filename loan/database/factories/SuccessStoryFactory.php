<?php

namespace Database\Factories;

use App\Models\SuccessStory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SuccessStoryFactory extends Factory
{
    protected $model = SuccessStory::class;

    public function definition(): array
    {
        $title = fake()->company() . ' Growth Story';

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(4),
            'summary' => fake()->paragraph(),
            'content' => '<p>' . fake()->paragraphs(3, true) . '</p>',
            'customer_name' => fake()->name(),
            'customer_company' => fake()->company(),
            'customer_location' => fake()->city(),
            'status' => 'published',
            'approval_status' => 'approved',
            'publish_date' => now(),
        ];
    }
}
