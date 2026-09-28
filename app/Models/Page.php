<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug', 'subtitle', 'featured_image', 'body', 'status',
        'sort_order', 'nav_group_id', 'parent_id', 'menu_order', 'nav_preview_items',
        'template', 'cta_label', 'cta_url', 'video_url', 'video_file',
    ];

    protected $casts = [
        'nav_preview_items' => 'array',
    ];

    public function navGroup(): BelongsTo
    {
        return $this->belongsTo(NavGroup::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('menu_order');
    }

    /**
     * Ubah berbagai bentuk link YouTube jadi URL embed, dengan autoplay
     * (wajib muted, browser modern nolak autoplay kalau ada suara) dan
     * permintaan kualitas 720p.
     * Kalau bukan link YouTube yang dikenali, dikembalikan apa adanya
     * (misal link Vimeo, biasanya sudah berupa embed link).
     */
    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (blank($this->video_url)) {
            return null;
        }

        $url = $this->video_url;

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/watch\?v=|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&mute=1&vq=hd720&rel=0';
        }

        return $url;
    }
}
