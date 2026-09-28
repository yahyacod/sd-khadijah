@extends('layouts.app')

@section('title', $post->title . ' SD Khadijah Wonorejo')

@section('content')

<div class="wrap" style="padding-top: 24px;">
    @include('partials.breadcrumb', ['items' => [
    ['label' => 'Beranda', 'url' => route('home')],
    ['label' => 'Berita & Kegiatan', 'url' => route('posts.index')],
    ['label' => $post->title, 'url' => null],
    ]])
</div>

<div class="wrap page-header" style="max-width: 800px;">

    <a href="{{ route('posts.index') }}" style="color: var(--muted); font-size: 0.9rem;">&larr; Kembali ke Berita</a>

    <h1 class="reveal" style="margin-top: 16px;">{{ $post->title }}</h1>
    @if($post->published_at)
    <p style="color: var(--muted); margin-top:-8px;">
        {{ $post->published_at->translatedFormat('d F Y') }}
    </p>
    @endif

    <article class="content-body">
        @if(trim(strip_tags($post->body ?? '')) !== '')
        {!! $post->body !!}
        @else
        <div class="empty-state">Konten berita ini belum diisi.</div>
        @endif
    </article>

    @if($related->count())
    <section style="margin-top: 56px; border-top: 1px solid var(--line); padding-top: 32px;" class="reveal">
        <h2 style="font-size:1.2rem;">Kegiatan Lainnya</h2>
        <div class="grid-cards" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-top:16px;">
            @foreach($related as $r)
            <a href="{{ route('posts.show', $r->slug) }}" class="card" style="padding:16px; display:block; font-size:0.95rem;">
                {{ $r->title }}
            </a>
            @endforeach
        </div>
    </section>
    @endif

</div>

@endsection