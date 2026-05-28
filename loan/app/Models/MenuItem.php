<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'parent_id',
        'page_id',
        'location',
        'label',
        'url',
        'target',
        'icon',
        'status',
        'sort_order',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function getHrefAttribute(): string
    {
        return $this->page ? url($this->page->slug === 'home' ? '/' : $this->page->slug) : ($this->url ?: '#');
    }
}
