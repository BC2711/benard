<?php

// app/Models/LoanCalculator.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanCalculator extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'stat_loan_range',
        'stat_interest_rates',
        'stat_loan_terms',
        'stat_payment_options',
        'min_amount',
        'max_amount',
        'default_amount',
        'min_rate',
        'max_rate',
        'default_rate',
        'min_days',
        'max_days',
        'default_days',
        'min_months',
        'max_months',
        'default_months',
        'payment_schedules',
        'cta_heading',
        'cta_description',
        'cta_apply_text',
        'cta_apply_url',
        'cta_contact_text',
        'cta_contact_url',
    ];

    protected $casts = [
        'payment_schedules' => 'array',
    ];
}
