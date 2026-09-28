<?php

use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/sitemap.xml', [SitemapController::class, 'index']);
// Beranda
Route::get('/', [PageController::class, 'home'])->name('home');

// Berita / kegiatan (posts hasil import dari WordPress)
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

// Halaman statis (profil, visi misi, ppdb, dll) — WAJIB paling akhir,
// supaya tidak "menelan" route /berita di atas.
Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('pages.show');
    