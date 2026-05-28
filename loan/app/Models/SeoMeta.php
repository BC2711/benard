<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'structured_data',
    ];

    protected $casts = [
        'structured_data' => 'array',
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
