<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>New Consultation Request</h1>
    {{-- @php dd($consultation)@endphp --}}

    <p><strong>Name:</strong> {{ $consultation->first_name }} {{ $consultation->last_name }}</p>
    <p><strong>Email:</strong> {{ $consultation->email }}</p>
    <p><strong>Phone:</strong> {{ $consultation->phone }}</p>
    <p><strong>Preferred Date:</strong> {{ $consultation->preferred_date->format('F j, Y') }}</p>
    <p><strong>Preferred Time:</strong>
        {{ \Carbon\Carbon::createFromFormat('H:i:s', $consultation->preferred_time)->format('g:i A') }}</p>

    <p><strong>Message:</strong><br>
        {{ $consultation->message ?? 'No additional message.' }}</p>

    @if (route('management.consultations.show', $consultation))
        <p>
            <a href="{{ route('management.consultations.show', $consultation) }}"
                style="background-color: #3b82f6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                View in Admin Panel
            </a>
        </p>
    @endif

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>

</html>
