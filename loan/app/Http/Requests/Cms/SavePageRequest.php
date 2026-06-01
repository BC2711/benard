<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SavePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'ADMIN';
    }

    public function rules(): array
    {
        $page = $this->route('page');

        return [
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('pages', 'slug')->ignore($page?->id)],
            'template' => ['required', 'string', 'max:80'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'is_homepage' => ['nullable', 'boolean'],
            'display_order' => ['required', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'scheduled_for' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after:now'],
            'content' => ['nullable', 'array'],
        ];
    }
}
