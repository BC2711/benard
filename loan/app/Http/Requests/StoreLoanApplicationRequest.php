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
            'businessType' => 'required|string|in:marketing-agency,ecommerce,content-creator,consulting,other',
            'loanAmount' => 'required|string|in:5k-25k,25k-75k,75k-150k,150k-plus',
            'loanPurpose' => 'required|string|in:marketing-campaign,business-expansion,equipment,working-capital,other',
            'timeline' => 'nullable|string|in:immediately,1-2-weeks,1-month,flexible',
            'message' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Please enter your full name',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'businessType.required' => 'Please select your business type',
            'loanAmount.required' => 'Please select your desired loan amount',
            'loanPurpose.required' => 'Please select the purpose of the loan',
        ];
    }
}
