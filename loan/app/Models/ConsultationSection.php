<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'info_heading',
        'benefits',
        'expectations',
        'expect_heading',
        'contact_heading',
        'contact_description',
        'phone',
        'email'
    ];

    protected $casts = [
        'benefits' => 'array',
        'expectations' => 'array',
    ];
}
