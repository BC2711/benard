<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureSection extends Model
{
    protected $fillable = [
        'badge_text',
        'badge_icon',
        'heading',
        'highlighted_text',
        'description',
        'stat_1_value',
        'stat_1_label',
        'stat_2_value',
        'stat_2_label',
        'stat_3_value',
        'stat_3_label',
        'stat_4_value',
        'stat_4_label',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_secondary_text',
        'cta_secondary_link',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
