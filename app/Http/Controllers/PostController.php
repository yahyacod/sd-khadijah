<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'publish')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $related = Post::where('status', 'publish')
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'related'));
    }
}
