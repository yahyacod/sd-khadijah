<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Page;
use App\Models\Post;

class PageController extends Controller
{
    public function home()
    {
        $home = Page::where('slug', 'home')
            ->orWhere('slug', 'beranda')
            ->where('status', 'publish')
            ->first();

        // Prioritaskan berita yang manual ditandai "Tampilkan di Beranda".
        // Kalau nggak ada satupun yang ditandai, otomatis fallback ke 3 terbaru.
        $latestPosts = Post::where('status', 'publish')
            ->where('is_featured_home', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        if ($latestPosts->isEmpty()) {
            $latestPosts = Post::where('status', 'publish')
                ->orderByDesc('published_at')
                ->take(3)
                ->get();
        }

        // Background hero: foto yang DIKURASI manual lewat admin > Slide Beranda.
        $heroSlides = HeroSlide::where('is_active', true)
            ->orderBy('sort_order')
            ->pluck('image');

        // Galeri "Momen Sekolah" di bawah: otomatis ambil dari foto utama
        // halaman & post — beda sumber dari hero, nggak perlu diatur manual.
        $galleryImages = Page::whereNotNull('featured_image')->pluck('featured_image')
            ->merge(Post::whereNotNull('featured_image')->pluck('featured_image'))
            ->unique()
            ->take(10);

        // Ambil video profil dari halaman (slug profile/video-profil atau halaman apapun yang ada video_url)
        $profilePage = Page::whereNotNull('video_url')
            ->where('status', 'publish')
            ->first();

        $videoEmbedUrl = $profilePage?->video_embed_url ?? 'https://www.youtube.com/embed/Rn78qED3ir0?autoplay=1&rel=0';

        return view('pages.home', compact('home', 'latestPosts', 'galleryImages', 'heroSlides', 'videoEmbedUrl'));
    }

    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $view = 'pages.show-' . $page->template;
        if (! view()->exists($view)) {
            $view = 'pages.show';
        }

        return view($view, compact('page'));
    }
}
