<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    // Define the table associated with the model
    protected $fillable = [
        'name',
        'menu_type',
        'parent_id',
        'url',
        'icon',
        'status',
        'type',
        'order',
    ];

    // Define relationship to fetch child menus
    public function childrenMenus()
    {
        return $this->hasMany(menu::class, 'parent_id')->orderBy('order', 'asc');
    }
}
