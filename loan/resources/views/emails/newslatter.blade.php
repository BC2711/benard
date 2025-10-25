{{-- resources/views/emails/subscribe.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Londa Loan News</title>
    <style>
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

        .welcome-box {
            background: #f8f9fa;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }

        .features {
            margin: 25px 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .feature-icon {
            background: #667eea;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Londa Loan</h1>
            <p>Newsletter Subscription Confirmed</p>
        </div>

        <div class="content">
            @if (isset($full_name))
                <h2>Welcome aboard, {{ $full_name }}! 👋</h2>
            @else
                <h2>Welcome aboard! 👋</h2>
            @endif

            <div class="welcome-box">
                <h3 style="color: #28a745; margin-top: 0;">🎉 Subscription Successful!</h3>
                <p>Thank you for subscribing to Londa Loan News. You're now part of our community and will be the first
                    to know about:</p>

                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon">💡</div>
                        <span>Latest loan products and updates</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📊</div>
                        <span>Financial tips and insights</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🎯</div>
                        <span>Exclusive offers and promotions</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📰</div>
                        <span>Industry news and trends</span>
                    </div>
                </div>
            </div>

            <p><strong>What to expect:</strong></p>
            <ul style="color: #555; line-height: 1.8;">
                <li>Monthly newsletter with curated content</li>
                <li>Important updates about your account</li>
                <li>Personalized loan recommendations</li>
                <li>Financial education resources</li>
            </ul>

            <div style="background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <p style="margin: 0; color: #0066cc;">
                    <strong>💡 Pro Tip:</strong> Make sure to add <em>news@londaloan.com</em> to your contacts to ensure
                    our emails don't end up in spam!
                </p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Londa Loan. All rights reserved.</p>
            <p>
                Londa Loan Inc.<br>
                Providing financial solutions for your needs
            </p>
            <p style="font-size: 12px; color: #adb5bd;">
                You're receiving this email because you subscribed to Londa Loan News.<br>
                <a href="{{ url('/unsubscribe') }}" style="color: #667eea;">Unsubscribe</a> at any time.
            </p>
        </div>
    </div>
</body>

</html>
