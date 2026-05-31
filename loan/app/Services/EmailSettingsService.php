<?php

namespace App\Services;

use App\Models\EmailSetting;

class EmailSettingsService
{
    public function defaults(): array
    {
        return [
            'mail_enabled' => true,
            'mailer' => env('MAIL_MAILER', 'smtp'),
            'host' => env('MAIL_HOST', ''),
            'port' => env('MAIL_PORT', 587),
            'scheme' => env('MAIL_SCHEME'),
            'username' => env('MAIL_USERNAME', ''),
            'password' => env('MAIL_PASSWORD', ''),
            'from_address' => env('MAIL_FROM_ADDRESS', ''),
            'from_name' => env('MAIL_FROM_NAME', config('app.name')),
            'admin_recipients' => env('MAIL_ADMIN_RECIPIENTS', env('MAIL_FROM_ADDRESS', '')),
            'two_factor_enabled' => env('MAIL_TWO_FACTOR_ENABLED', false),
        ];
    }

    public function all(): array
    {
        $settings = $this->defaults();

        foreach (EmailSetting::all() as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return $settings;
    }

    public function update(array $settings): void
    {
        foreach ($settings as $key => $value) {
            if ($key === 'password' && blank($value)) {
                continue;
            }

            EmailSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function adminRecipients(): array
    {
        return collect(explode(',', (string) $this->all()['admin_recipients']))
            ->map(fn (string $email) => trim($email))
            ->filter(fn (string $email) => filter_var($email, FILTER_VALIDATE_EMAIL))
            ->values()
            ->all();
    }

    public function mailEnabled(): bool
    {
        return filter_var($this->all()['mail_enabled'], FILTER_VALIDATE_BOOL);
    }

    public function twoFactorEnabled(): bool
    {
        return filter_var($this->all()['two_factor_enabled'], FILTER_VALIDATE_BOOL);
    }

    public function applyMailerConfiguration(): void
    {
        $settings = $this->all();
        $mailer = $settings['mailer'] ?: 'smtp';

        config([
            'mail.default' => $mailer,
            'mail.from.address' => $settings['from_address'],
            'mail.from.name' => $settings['from_name'],
        ]);

        if ($mailer === 'smtp') {
            config([
                'mail.mailers.smtp.host' => $settings['host'],
                'mail.mailers.smtp.port' => (int) $settings['port'],
                'mail.mailers.smtp.scheme' => $settings['scheme'] ?: null,
                'mail.mailers.smtp.username' => $settings['username'] ?: null,
                'mail.mailers.smtp.password' => $settings['password'] ?: null,
            ]);
        }

        app('mail.manager')->purge();
    }
}
