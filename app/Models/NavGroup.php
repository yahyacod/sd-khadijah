<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavGroup extends Model
{
    protected $fillable = [
        'name', 'sort_order', 'extra_link_label', 'extra_link_url',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
