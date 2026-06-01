<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SavePageSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'ADMIN';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:180'],
            'section_key' => ['required', 'string', 'max:120'],
            'type' => ['required', Rule::in([
                'hero', 'about', 'services', 'features', 'statistics', 'team', 'testimonials',
                'faq', 'gallery', 'video', 'pricing', 'partners', 'blog', 'contact',
                'newsletter', 'custom',
            ])],
            'component' => ['nullable', 'string', 'max:160'],
            'status' => ['required', Rule::in(['draft', 'published', 'disabled'])],
            'sort_order' => ['required', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'scheduled_for' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after:now'],
        ];
    }
}
