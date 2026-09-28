<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect();

        $urls->push([
            'loc' => route('home'),
            'lastmod' => now()->toAtomString(),
            'priority' => '1.0',
        ]);

        $urls->push([
            'loc' => route('posts.index'),
            'lastmod' => now()->toAtomString(),
            'priority' => '0.8',
        ]);

        Page::where('status', 'publish')->get()->each(function ($page) use ($urls) {
            $urls->push([
                'loc' => url($page->slug),
                'lastmod' => $page->updated_at->toAtomString(),
                'priority' => '0.7',
            ]);
        });

        Post::where('status', 'publish')->get()->each(function ($post) use ($urls) {
            $urls->push([
                'loc' => route('posts.show', $post->slug),
                'lastmod' => $post->updated_at->toAtomString(),
                'priority' => '0.6',
            ]);
        });

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
