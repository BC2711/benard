<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailDeliveryLog extends Model
{
    protected $fillable = [
        'tracking_token',
        'template_key',
        'recipient',
        'subject',
        'context',
        'status',
        'attempts',
        'error_message',
        'queued_at',
        'sent_at',
        'failed_at',
        'opened_at',
        'clicked_at',
    ];

    protected function casts(): array
    {
        return [
            'context' => 'encrypted:array',
            'queued_at' => 'datetime',
            'sent_at' => 'datetime',
            'failed_at' => 'datetime',
            'opened_at' => 'datetime',
            'clicked_at' => 'datetime',
        ];
    }
}
