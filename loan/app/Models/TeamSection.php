<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'members',
    ];

    protected $casts = [
        'members' => 'array',
    ];
}
