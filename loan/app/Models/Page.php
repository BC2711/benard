<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'template',
        'status',
        'is_homepage',
        'display_order',
        'content',
        'featured_image',
        'published_at',
        'scheduled_for',
        'expires_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'content' => 'array',
        'is_homepage' => 'boolean',
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function publishedSections()
    {
        return $this->sections()->published();
    }

    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function versions()
    {
        return $this->morphMany(ContentVersion::class, 'versionable')->latest('version');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->where(fn ($q) => $q->whereNull('scheduled_for')->orWhere('scheduled_for', '<=', now()))
            ->where(fn ($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()));
    }
}
