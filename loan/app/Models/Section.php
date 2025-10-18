<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'section_type',
        'content',
        'published_at',
        'author',
        'last_modified_by',
    ];

    protected $casts = [
        'content' => 'array',
        'published_at' => 'datetime',
    ];

    /**
     * Scope a query to only include sections of a given type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('section_type', $type);
    }

    /**
     * Get the user that created the section.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'author');
    }

    /**
     * Get the user that last modified the section.
     */
    public function lastModifiedBy()
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }
}
