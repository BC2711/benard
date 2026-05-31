<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company',
        'business_type',
        'loan_amount',
        'loan_purpose',
        'timeline',
        'message',
        'status',
    ];
}
