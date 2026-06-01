<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuccessStory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'title', 'slug', 'summary', 'content', 'customer_name',
        'customer_occupation', 'customer_location', 'customer_company', 'customer_photo',
        'featured_image', 'gallery', 'video_url', 'is_featured', 'show_on_homepage',
        'show_in_testimonials', 'show_on_landing_pages', 'status', 'approval_status',
        'publish_date', 'expires_at', 'display_order', 'loan_amount', 'currency',
        'business_growth_percentage', 'revenue_increase', 'jobs_created',
        'custom_statistics', 'meta_title', 'meta_description', 'meta_keywords',
        'og_image', 'created_by', 'updated_by', 'approved_by', 'approved_at',
    ];

    protected $casts = [
        'gallery' => 'array',
        'custom_statistics' => 'array',
        'is_featured' => 'boolean',
        'show_on_homepage' => 'boolean',
        'show_in_testimonials' => 'boolean',
        'show_on_landing_pages' => 'boolean',
        'publish_date' => 'datetime',
        'expires_at' => 'datetime',
        'approved_at' => 'datetime',
        'loan_amount' => 'decimal:2',
        'business_growth_percentage' => 'decimal:2',
        'revenue_increase' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where('approval_status', 'approved')
            ->where(fn ($q) => $q->whereNull('publish_date')->orWhere('publish_date', '<=', now()))
            ->where(fn ($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
