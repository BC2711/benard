<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'section_label',
        'heading',
        'highlighted_text',
        'description',
        'cta_text',
        'cta_link',
        'stat_1_value',
        'stat_1_label',
        'stat_2_value',
        'stat_2_label',
        'stat_3_value',
        'stat_3_label',
        'stat_4_value',
        'stat_4_label',
        'features',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'rating_icon',
        'rating_value',
        'rating_subtitle',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
