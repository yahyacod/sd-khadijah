<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'subtitle', 'featured_image', 'body', 'status', 'published_at', 'is_featured_home'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured_home' => 'boolean'
    ];
}
