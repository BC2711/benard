<?php

// app/Models/TrustedClientsSection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrustedClientsSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'industry_badges',
        'clients',
        'highlights',
        'testimonials',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'trust_indicators',
    ];

    protected $casts = [
        'industry_badges' => 'array',
        'clients' => 'array',
        'highlights' => 'array',
        'testimonials' => 'array',
        'trust_indicators' => 'array',
    ];
}
