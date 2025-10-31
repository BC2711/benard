<?php

// app/Models/SupportSection.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'steps',
        'email',
        'phone',
        'address_line1',
        'address_line2',
        'hours_line1',
        'hours_line2',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'form_heading',
        'form_subheading',
        'trust_indicators',
    ];

    protected $casts = [
        'steps' => 'array',
        'trust_indicators' => 'array',
    ];
}
