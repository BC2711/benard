<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'message',
        'status'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime:H:i',
    ];
}
