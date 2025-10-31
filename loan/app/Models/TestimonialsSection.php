<?php

// app/Models/TestimonialsSection.php
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
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'testimonials',
    ];

    protected $casts = [
        'stats' => 'array',
        'testimonials' => 'array',
    ];
}
