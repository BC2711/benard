<?php

// app/Http/Controllers/LoanApplicationController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanApplicationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoanApplicationSubmitted;

class LoanApplicationController extends Controller
{
    public function store(StoreLoanApplicationRequest $request)
    {
        $data = $request->validated();

        // Send email (configure in .env)
        Mail::to(config('mail.from.address'))->send(new LoanApplicationSubmitted($data));

        return response()->json([
            'success' => true,
            'message' => 'Application submitted! We\'ll contact you within 24 hours.'
        ]);
    }
}
