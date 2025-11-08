@component('mail::message')
    # Thank You for Your Consultation Request!

    Hi **{{ $consultation->first_name }}**,

    We've received your request for a **free consultation** on:

    **{{ $consultation->preferred_date->format('F j, Y') }} at
    {{ \Carbon\Carbon::createFromFormat('H:i:s', $consultation->preferred_time)->format('g:i A') }}**

    One of our financial experts will contact you **within 24 hours** to confirm and prepare for your session.

    **What to Expect:**
    - A 30-minute call tailored to your business
    - Personalized funding recommendations
    - No obligation

    Need to change your time? Reply to this email or call us at **{{ config('mail.from.phone', '+1 (555) 123-4567') }}**

    We look forward to helping you grow!

    Best regards,
    The {{ config('app.name') }} Team
@endcomponent
