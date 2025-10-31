<?php

// app/Models/SuccessStoriesSection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStoriesSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'stats',
        'categories',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'stories',
    ];

    protected $casts = [
        'stats' => 'array',
        'categories' => 'array',
        'stories' => 'array',
    ];
}
