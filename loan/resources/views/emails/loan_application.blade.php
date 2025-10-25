{{-- resources/views/emails/loan-application.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application - {{ config('app.name') }}</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content {
            padding: 40px 30px;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }

        .application-details {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <h1>Loan Application {{ isset($status) ? 'Update' : 'Received' }}</h1>
        </div>

        <!-- Content -->
        <div class="content">
            @if (isset($greeting))
                <h2>Hello {{ $greeting }},</h2>
            @else
                <h2>Hello,</h2>
            @endif

            @if (isset($status) && $status === 'approved')
                <div class="info-box">
                    <h3 style="color: #28a745; margin-top: 0;">🎉 Loan Application Approved!</h3>
                    <p>Congratulations! Your loan application has been approved.</p>
                </div>
            @elseif(isset($status) && $status === 'rejected')
                <div class="info-box">
                    <h3 style="color: #dc3545; margin-top: 0;">❌ Loan Application Update</h3>
                    <p>We regret to inform you that your loan application was not approved at this time.</p>
                </div>
            @else
                <div class="info-box">
                    <h3 style="color: #667eea; margin-top: 0;">📋 Loan Application Received</h3>
                    <p>Thank you for submitting your loan application. We're currently reviewing your information.</p>
                </div>
            @endif

            <!-- Application Details -->
            <div class="application-details">
                <h3 style="margin-top: 0; color: #333;">Application Details</h3>

                @if (isset($applicationId))
                    <div class="detail-row">
                        <span><strong>Application ID:</strong></span>
                        <span>#{{ $applicationId }}</span>
                    </div>
                @endif

                @if (isset($loanAmount))
                    <div class="detail-row">
                        <span><strong>Loan Amount:</strong></span>
                        <span>${{ number_format($loanAmount, 2) }}</span>
                    </div>
                @endif

                @if (isset($loanPurpose))
                    <div class="detail-row">
                        <span><strong>Purpose:</strong></span>
                        <span>{{ $loanPurpose }}</span>
                    </div>
                @endif

                @if (isset($loanTerm))
                    <div class="detail-row">
                        <span><strong>Loan Term:</strong></span>
                        <span>{{ $loanTerm }} months</span>
                    </div>
                @endif

                @if (isset($interestRate))
                    <div class="detail-row">
                        <span><strong>Interest Rate:</strong></span>
                        <span>{{ $interestRate }}%</span>
                    </div>
                @endif

                @if (isset($applicationDate))
                    <div class="detail-row">
                        <span><strong>Application Date:</strong></span>
                        <span>{{ $applicationDate }}</span>
                    </div>
                @endif

                @if (isset($status))
                    <div class="detail-row">
                        <span><strong>Status:</strong></span>
                        <span class="status-badge status-{{ $status }}">
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                @endif
            </div>

            <!-- Next Steps -->
            @if (!isset($status) || $status === 'pending')
                <div style="margin: 25px 0;">
                    <h3 style="color: #333;">Next Steps</h3>
                    <ul style="color: #555; line-height: 1.8;">
                        <li>We will review your application within 2-3 business days</li>
                        <li>You may be contacted for additional information</li>
                        <li>Check your application status anytime through your dashboard</li>
                    </ul>
                </div>
            @endif

            @if (isset($status) && $status === 'approved')
                <div style="margin: 25px 0;">
                    <h3 style="color: #333;">Next Steps</h3>
                    <ul style="color: #555; line-height: 1.8;">
                        <li>Funds will be disbursed within 24-48 hours</li>
                        <li>Review your loan agreement carefully</li>
                        <li>Set up your repayment schedule</li>
                    </ul>
                </div>
            @endif

            <!-- Action Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $dashboardUrl ?? '#' }}" class="button">
                    {{ isset($status) && $status === 'approved' ? 'View Loan Agreement' : 'View Application Status' }}
                </a>
            </div>

            <!-- Contact Information -->
            <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 20px;">
                <p style="margin: 0; color: #6c757d; font-size: 14px;">
                    Need assistance? Contact our support team at
                    <a href="mailto:support@{{ config('app.domain', 'example.com') }}" style="color: #667eea;">
                        support@{{ config('app.domain', 'example.com') }}
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>
                {{ config('app.name') }}<br>
                {{ $companyAddress ?? '123 Financial District, City, State 12345' }}
            </p>
            <p style="font-size: 12px; color: #adb5bd;">
                This email was sent to you regarding your loan application.
                Please do not reply to this email.
            </p>
        </div>
    </div>
</body>

</html>
