@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan — SD Khadijah Wonorejo')

@php
// Ambil beberapa halaman yang PASTI valid & publish langsung dari
// database — bukan slug yang di-hardcode, jadi nggak akan pernah
// nunjuk ke halaman yang sudah dihapus/di-rename adminnya.
$suggestions = \App\Models\Page::where('status', 'publish')
->whereNotNull('nav_group_id')
->whereNull('parent_id')
->inRandomOrder()
->limit(3)
->get();
@endphp

@section('content')

<div class="wrap" style="padding: 90px 0; text-align:center; max-width: 620px;">

    <span class="eyebrow">Oops</span>
    <h1 class="display" style="font-size: clamp(3.5rem, 10vw, 6rem); color: var(--gold); margin-bottom: 0;">404</h1>
    <h2 style="margin-top: 4px;">Halaman Tidak Ditemukan</h2>

    <p style="color: var(--muted); font-size: 1.02rem; margin: 16px 0 32px;">
        Halaman yang kamu cari mungkin sudah dipindah, dihapus, atau alamatnya salah ketik.
        Yuk kembali ke beranda atau cek beberapa halaman berikut.
    </p>

    <a href="{{ route('home') }}" class="btn btn-green">Kembali ke Beranda &rarr;</a>

    @if($suggestions->isNotEmpty())
    <div style="margin-top: 40px; display:flex; gap: 12px; flex-wrap: wrap; justify-content:center;">
        <a href="{{ route('posts.index') }}" class="card" style="padding: 10px 18px; font-size: 0.88rem;">Berita &amp; Kegiatan</a>
        @foreach($suggestions as $page)
        <a href="{{ url($page->slug) }}" class="card" style="padding: 10px 18px; font-size: 0.88rem;">{{ $page->title }}</a>
        @endforeach
    </div>
    @endif

</div>

@endsection