<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessStoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'content' => $this->content,
            'customer' => [
                'name' => $this->customer_name,
                'occupation' => $this->customer_occupation,
                'location' => $this->customer_location,
                'company' => $this->customer_company,
                'photo' => $this->customer_photo,
            ],
            'featured_image' => $this->featured_image,
            'gallery' => $this->gallery ?? [],
            'video_url' => $this->video_url,
            'category' => $this->whenLoaded('category'),
            'tags' => $this->whenLoaded('tags'),
            'metrics' => [
                'loan_amount' => $this->loan_amount,
                'currency' => $this->currency,
                'business_growth_percentage' => $this->business_growth_percentage,
                'revenue_increase' => $this->revenue_increase,
                'jobs_created' => $this->jobs_created,
                'custom' => $this->custom_statistics ?? [],
            ],
            'is_featured' => $this->is_featured,
            'publish_date' => $this->publish_date?->toAtomString(),
        ];
    }
}
