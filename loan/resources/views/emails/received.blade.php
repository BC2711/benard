<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Request Confirmation</title>
</head>

<body>
    <h1>Consultation Request Received</h1>

    <p>Dear {{ $consultation->first_name }},</p>

    <p>Thank you for your consultation request. We have received your information and will contact you soon to confirm
        your appointment.</p>

    <h2>Your Request Details:</h2>
    <p><strong>Name:</strong> {{ $consultation->first_name }} {{ $consultation->last_name }}</p>
    <p><strong>Email:</strong> {{ $consultation->email }}</p>
    <p><strong>Phone:</strong> {{ $consultation->phone }}</p>
    <p><strong>Preferred Date:</strong>
        @if ($consultation->preferred_date)
            {{ \Carbon\Carbon::parse($consultation->preferred_date)->format('F j, Y') }}
        @else
            Not specified
        @endif
    </p>
    <p><strong>Preferred Time:</strong>
        @if ($consultation->preferred_time)
            {{ \Carbon\Carbon::parse($consultation->preferred_time)->format('g:i A') }}
        @else
            Not specified
        @endif
    </p>

    @if ($consultation->message)
        <p><strong>Your Message:</strong><br>{{ $consultation->message }}</p>
    @endif

    <p>We will review your request and contact you within 24-48 hours to confirm your appointment time.</p>

    <p>If you have any questions, please don't hesitate to contact us.</p>

    <p>Best regards,<br>{{ config('app.name') }} Team</p>
</body>

</html>
