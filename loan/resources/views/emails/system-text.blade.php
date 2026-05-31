{!! $textBody !!}

@if ($actionUrl)

{{ $actionText ?: 'Continue' }}: {{ $actionUrl }}
@endif

--
{{ config('app.name') }}
