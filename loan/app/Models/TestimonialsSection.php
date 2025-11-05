<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialsSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'video_title',
        'video_description',
        'video_image',
        'video_url',
        'stats',
        'testimonials',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'video_image_path',
        'video_file_path',
    ];

    protected $casts = [
        'stats' => 'array',
        'testimonials' => 'array',
    ];

    public function getVideoImageUrlAttribute()
    {
        return $this->video_image_path
            ? asset('storage/' . $this->video_image_path)
            : $this->video_image;
    }

    public function getVideoUrlAttribute()
    {
        return $this->video_file_path ? asset('storage/' . $this->video_file_path) : '';
    }

    public static function getSection()
    {
        return static::first() ?? static::create([
            'heading' => 'What Our Marketeers Say',
            'description' => 'Hear from marketing professionals...',
            'video_title' => "Sarah's Success Story",
            'video_description' => 'See how Sarah transformed her marketing agency...',
            'video_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978',
            'stats' => [],
            'cta_heading' => 'Join hundreds of successful marketeers',
            'cta_description' => 'Get the funding you need...',
            'cta_primary_text' => 'Apply Now',
            'cta_primary_link' => '#consultation',
            'cta_primary_icon' => 'fa-paper-plane',
            'cta_secondary_text' => 'Read More Reviews',
            'cta_secondary_link' => '#testimonials',
            'cta_secondary_icon' => 'fa-star',
            'testimonials' => [],
        ]);
    }
}
