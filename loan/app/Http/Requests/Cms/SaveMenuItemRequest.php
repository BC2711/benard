<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'ADMIN';
    }

    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:menu_items,id'],
            'page_id' => ['nullable', 'exists:pages,id'],
            'location' => ['required', Rule::in(['primary', 'footer'])],
            'label' => ['required', 'string', 'max:120'],
            'url' => ['nullable', 'string', 'max:255'],
            'target' => ['required', Rule::in(['_self', '_blank'])],
            'icon' => ['nullable', 'string', 'max:120'],
            'status' => ['required', Rule::in(['draft', 'published', 'disabled'])],
            'sort_order' => ['required', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after:now'],
        ];
    }
}
