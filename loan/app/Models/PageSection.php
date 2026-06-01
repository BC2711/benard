<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'page_id',
        'name',
        'section_key',
        'type',
        'component',
        'status',
        'sort_order',
        'content',
        'settings',
        'published_at',
        'scheduled_for',
        'expires_at',
    ];

    protected $casts = [
        'content' => 'array',
        'settings' => 'array',
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->where(fn ($q) => $q->whereNull('scheduled_for')->orWhere('scheduled_for', '<=', now()))
            ->where(fn ($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()));
    }

    public function versions()
    {
        return $this->morphMany(ContentVersion::class, 'versionable')->latest('version');
    }
}
