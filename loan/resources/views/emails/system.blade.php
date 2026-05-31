<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subjectLine }}</title>
</head>
<body style="margin:0;background:#f1f5f9;color:#0f172a;font-family:Arial,sans-serif">
    <div style="max-width:640px;margin:0 auto;padding:28px 16px">
        <div style="overflow:hidden;border-radius:18px;background:#ffffff;box-shadow:0 12px 35px rgba(15,23,42,.08)">
            <div style="background:#155e75;padding:24px;color:#ffffff">
                <table role="presentation" width="100%">
                    <tr>
                        <td style="font-size:23px;font-weight:800">
                            <img src="{{ asset('assets/logos/londa.jpg') }}" alt="{{ config('app.name') }}" width="38" height="38"
                                style="display:inline-block;margin-right:10px;border-radius:9px;vertical-align:middle">
                            <span style="vertical-align:middle">{{ config('app.name') }}</span>
                        </td>
                        <td align="right" style="font-size:12px;color:#cffafe">Lending support</td>
                    </tr>
                </table>
            </div>
            <div style="padding:30px;font-size:15px;line-height:1.7">
                {!! $htmlBody !!}

                @if ($actionUrl)
                    <p style="margin:28px 0 8px">
                        <a href="{{ route('email.track.click', $trackingToken) }}"
                            style="display:inline-block;border-radius:9px;background:#d99b2b;padding:12px 20px;color:#ffffff;text-decoration:none;font-weight:700">
                            {{ $actionText ?: 'Continue' }}
                        </a>
                    </p>
                @endif
            </div>
            <div style="border-top:1px solid #e2e8f0;background:#f8fafc;padding:20px 30px;color:#64748b;font-size:12px;line-height:1.6">
                This email was sent by {{ config('app.name') }}. Please contact our team if you need assistance.
            </div>
        </div>
    </div>
    <img src="{{ route('email.track.open', $trackingToken) }}" alt="" width="1" height="1" style="display:block;width:1px;height:1px">
</body>
</html>
