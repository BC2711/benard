<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactNumbersSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'main_stats',
        'performance_metrics',
        'industry_impact',
        'timeline',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'trust_badges',
    ];

    protected $casts = [
        'main_stats' => 'array',
        'performance_metrics' => 'array',
        'industry_impact' => 'array',
        'timeline' => 'array',
        'trust_badges' => 'array',
    ];
}
