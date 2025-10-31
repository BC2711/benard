<?php

// app/Http/Requests/StoreLoanApplicationRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'businessType' => 'required|in:marketing-agency,ecommerce,content-creator,consulting,other',
            'loanAmount' => 'required|in:5k-25k,25k-75k,75k-150k,150k-plus',
            'loanPurpose' => 'required|in:marketing-campaign,business-expansion,equipment,working-capital,other',
            'timeline' => 'nullable|in:immediately,1-2-weeks,1-month,flexible',
            'message' => 'nullable|string',
        ];
    }
}
