<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveSuccessStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'ADMIN';
    }

    public function rules(): array
    {
        $story = $this->route('success_story');

        return [
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('success_stories', 'slug')->ignore($story?->id)],
            'summary' => ['required', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'category_name' => ['nullable', 'string', 'max:120'],
            'tags' => ['nullable', 'string', 'max:500'],
            'customer_name' => ['required', 'string', 'max:180'],
            'customer_occupation' => ['nullable', 'string', 'max:180'],
            'customer_location' => ['nullable', 'string', 'max:180'],
            'customer_company' => ['nullable', 'string', 'max:180'],
            'customer_photo' => ['nullable', 'image', 'max:5120'],
            'customer_photo_path' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'image', 'max:8192'],
            'featured_image_path' => ['nullable', 'string', 'max:255'],
            'gallery_images' => ['nullable', 'array', 'max:12'],
            'gallery_images.*' => ['image', 'max:8192'],
            'existing_gallery' => ['nullable', 'string'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'loan_amount' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'max:8'],
            'business_growth_percentage' => ['nullable', 'numeric', 'min:0'],
            'revenue_increase' => ['nullable', 'numeric', 'min:0'],
            'jobs_created' => ['nullable', 'integer', 'min:0'],
            'custom_statistics_json' => ['nullable', 'json'],
            'is_featured' => ['nullable', 'boolean'],
            'show_on_homepage' => ['nullable', 'boolean'],
            'show_in_testimonials' => ['nullable', 'boolean'],
            'show_on_landing_pages' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'approval_status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'publish_date' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after:now'],
            'display_order' => ['required', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'string', 'max:255'],
        ];
    }
}
