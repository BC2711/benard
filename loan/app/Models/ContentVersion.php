<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentVersion extends Model
{
    protected $fillable = ['versionable_type', 'versionable_id', 'version', 'snapshot', 'created_by'];

    protected $casts = [
        'snapshot' => 'array',
    ];

    public function versionable()
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
