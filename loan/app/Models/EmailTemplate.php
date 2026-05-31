<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'key',
        'name',
        'subject',
        'body_html',
        'body_text',
        'variables',
        'enabled',
    ];

    protected function casts(): array
    {
        return [
            'variables' => 'array',
            'enabled' => 'boolean',
        ];
    }
}
