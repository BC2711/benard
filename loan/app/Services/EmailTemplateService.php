<?php

namespace App\Services;

use App\Models\EmailTemplate;

class EmailTemplateService
{
    public function syncDefaults(): void
    {
        foreach (config('email_templates', []) as $key => $template) {
            EmailTemplate::firstOrCreate(
                ['key' => $key],
                [
                    ...$template,
                    'key' => $key,
                    'enabled' => true,
                ],
            );
        }
    }

    public function find(string $key): array
    {
        $stored = EmailTemplate::where('key', $key)->first();

        if ($stored) {
            return $stored->toArray();
        }

        $template = config('email_templates', [])[$key] ?? null;

        if (!$template) {
            throw new \InvalidArgumentException("Unknown email template [{$key}].");
        }

        return [...$template, 'key' => $key, 'enabled' => true];
    }

    public function render(string $key, array $context): array
    {
        $template = $this->find($key);
        $context = ['app_name' => config('app.name'), ...$context];

        return [
            'enabled' => (bool) $template['enabled'],
            'subject' => $this->replace($template['subject'], $context, false),
            'html' => $this->replace($template['body_html'], $context, true),
            'text' => $this->replace($template['body_text'], $context, false),
        ];
    }

    private function replace(string $content, array $context, bool $escape): string
    {
        return (string) preg_replace_callback('/{{\s*([a-zA-Z0-9_]+)\s*}}/', function (array $match) use ($context, $escape) {
            $value = $context[$match[1]] ?? '';

            if (is_array($value) || is_object($value)) {
                $value = json_encode($value, JSON_UNESCAPED_SLASHES);
            }

            return $escape ? e((string) $value) : (string) $value;
        }, $content);
    }
}
