<?php

// app/Models/TeamSection.php
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
        'members'
    ];

    protected $casts = [
        'members' => 'array'
    ];

    public static function getInstance()
    {
        return static::first() ?: static::create([
            'heading' => 'Meet Our Financial Experts',
            'description' => 'Our team of financial specialists understands the unique needs...',
            'cta_heading' => 'Ready to speak with our experts?',
            'cta_description' => 'Get personalized loan advice...',
            'cta_primary_text' => 'Schedule Consultation',
            'cta_primary_link' => '#contact',
            'cta_primary_icon' => 'fa-calendar-check',
            'cta_secondary_text' => 'Meet the Team',
            'cta_secondary_link' => '#team',
            'cta_secondary_icon' => 'fa-users',
            'members' => []
        ]);
    }
}
