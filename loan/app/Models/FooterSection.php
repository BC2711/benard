<?php

// app/Models/FooterSection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSection extends Model
{
    protected $fillable = [
        'brand_name',
        'brand_tagline',
        'brand_description',
        'email',
        'address_line1',
        'address_line2',
        'phone',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'quick_links',
        'resources',
        'newsletter_heading',
        'newsletter_description',
        'trust_badges',
        'legal_links',
        'copyright_text',
        'footer_note',
    ];

    protected $casts = [
        'quick_links' => 'array',
        'resources' => 'array',
        'trust_badges' => 'array',
        'legal_links' => 'array',
    ];
}
