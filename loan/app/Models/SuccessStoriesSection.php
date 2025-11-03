<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStoriesSection extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'stats',
        'categories',
        'cta_heading',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_primary_icon',
        'cta_secondary_text',
        'cta_secondary_link',
        'cta_secondary_icon',
        'stories',
    ];

    protected $casts = [
        'stats'      => 'array',
        'categories' => 'array',
        'stories'    => 'array',
    ];

    /** -----------------------------------------------------------------
     *  Accessors – guarantee an *array* even if the DB column is null,
     *  malformed JSON, or still a string.
     * ----------------------------------------------------------------- */
    public function getCategoriesAttribute($value)
    {
        return $this->castToArray($value);
    }

    public function getStatsAttribute($value)
    {
        return $this->castToArray($value);
    }

    public function getStoriesAttribute($value)
    {
        return $this->castToArray($value);
    }

    /** Helper used by the accessors */
    protected function castToArray($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }
}
