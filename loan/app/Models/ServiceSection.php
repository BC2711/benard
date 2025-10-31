<?php

// app/Models/ServiceSection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    protected $fillable = [
        'badge_text',
        'badge_icon',
        'heading',
        'highlighted_text',
        'description',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'info_1_icon',
        'info_1_title',
        'info_1_subtitle',
        'info_2_icon',
        'info_2_title',
        'info_2_subtitle',
        'info_3_icon',
        'info_3_title',
        'info_3_subtitle',
        'services',
    ];

    protected $casts = [
        'services' => 'array',
    ];
}
