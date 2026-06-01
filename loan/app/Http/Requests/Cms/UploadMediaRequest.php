<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'ADMIN';
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'max:51200', 'mimes:jpg,jpeg,png,gif,webp,svg,mp4,webm,pdf,doc,docx,xls,xlsx'],
            'folder' => ['required', 'string', 'max:120'],
            'name' => ['nullable', 'string', 'max:180'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
        ];
    }
}
