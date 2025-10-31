<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'brand_name',
        'brand_tagline',
        'heading',
        'highlighted_text',
        'description',
        'cta_text',
        'cta_link',
        'phone_number',
        'phone_label',
        'stat_1_value',
        'stat_1_label',
        'stat_2_value',
        'stat_2_label',
        'stat_3_value',
        'stat_3_label',
        'stat_4_value',
        'stat_4_label',
        'card_title',
        'card_description',
        'hero_image',
        'badge_1_icon',
        'badge_1_title',
        'badge_1_subtitle',
        'badge_2_icon',
        'badge_2_title',
        'badge_2_subtitle',
    ];
}
