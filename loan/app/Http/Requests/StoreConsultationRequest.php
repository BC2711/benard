<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|in:09:00,10:00,11:00,13:00,14:00,15:00,16:00',
            'message' => 'nullable|string|max:2000',
            'g-recaptcha-response' => 'nullable|recaptcha', 
        ];
    }

    public function messages()
    {
        return [
            'preferred_date.after_or_equal' => 'Please select a future date.',
            'preferred_time.in' => 'Please select a valid time slot.',
        ];
    }
}
