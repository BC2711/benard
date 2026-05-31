# Email System

## Overview

All active website email workflows use `App\Services\EmailDeliveryService`. The service creates an encrypted-context delivery log and dispatches `App\Jobs\SendTemplatedEmail` to the `emails` queue. The job tries delivery three times with 1, 5, and 15 minute delays.

The admin panel provides:

- `Management > Email Settings` for SMTP settings, administrator recipients, test messages, and email-code 2FA.
- `Management > Email Templates` for enabling, editing, and previewing system templates.
- `Management > Email Logs` for queued, retrying, sent, failed, opened, and clicked deliveries.

## Production Configuration

Set these values in `.env`:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_SCHEME=null
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"
MAIL_ADMIN_RECIPIENTS="operations@example.com"
QUEUE_CONNECTION=database

RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=
```

Run the database migrations and start a persistent worker:

```bash
php artisan migrate --force
php artisan db:seed --class=EmailTemplateSeeder --force
php artisan optimize:clear
php artisan queue:work --queue=emails,default --tries=3
```

Use a process manager such as Supervisor or systemd in production. SMTP values configured in the admin panel override `.env` values and are encrypted at rest. Leaving the admin SMTP password field blank preserves the stored password.

## Active Workflows

- Newsletter signup: subscriber confirmation and administrator notification.
- Consultation request: customer confirmation and administrator notification.
- Loan application: persistent application record, customer confirmation, and administrator notification.
- Registration: signed email verification link, then welcome email.
- Password recovery: reset link and password-change confirmation.
- Management login: login activity email, lockout security alert, recovery email, and optional email-code 2FA.
- Account management: profile update, pending email-change verification, password change, account activation/deactivation, and unlock notifications.

Public forms use rate limits and honeypot fields. Add the reCAPTCHA keys in production to require Google's CAPTCHA verification.

## Adding A Notification

1. Add a template definition to `config/email_templates.php`.
2. Add editable placeholders to the template's `variables` list.
3. Run `php artisan db:seed --class=EmailTemplateSeeder --force`.
4. Queue the email from the workflow:

```php
app(\App\Services\EmailDeliveryService::class)->queue(
    'workflow.template_key',
    $recipient,
    ['placeholder' => 'value'],
);
```

Every template needs responsive HTML content and a plain-text fallback. Placeholder values are escaped when rendered into HTML.

## Monitoring Notes

`sent` means the configured mail transport accepted the message. Open tracking uses a one-pixel image and click tracking uses the primary action link, so privacy tools and image blocking can affect engagement data. Provider-level bounce and complaint webhooks are not available through generic SMTP; add a provider-specific webhook endpoint if the deployed provider supports them.
