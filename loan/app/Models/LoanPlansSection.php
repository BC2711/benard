<?php

// app/Models/LoanPlansSection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPlansSection extends Model
{
    protected $fillable = [
        'heading',
        'highlighted_text',
        'description',
        'short_term_label',
        'long_term_label',
        'short_term_desc',
        'long_term_desc',
        'custom_badge',
        'custom_heading',
        'custom_description',
        'custom_link_text',
        'custom_link',
        'custom_link_icon',
        'custom_flexible_text',
        'custom_flexible_subtext',
        'custom_rate_text',
        'custom_benefits',
        'pricing_cards',
    ];

    protected $casts = [
        'custom_benefits' => 'array',
        'pricing_cards'   => 'array',
    ];
}
