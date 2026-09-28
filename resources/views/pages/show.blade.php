@extends('layouts.app')

@section('title', $page->title . ' SD Khadijah Wonorejo')

@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($page->body), 155))
@if($page->featured_image)
@section('og_image', asset('storage/' . $page->featured_image))
@endif

@section('content')

<div class="wrap" style="padding-top: 24px;">
    @php
    $breadcrumb = [['label' => 'Beranda', 'url' => route('home')]];
    if ($page->navGroup) {
    $breadcrumb[] = ['label' => $page->navGroup->name, 'url' => null];
    }
    if ($page->parent) {
    $breadcrumb[] = ['label' => $page->parent->title, 'url' => url($page->parent->slug)];
    }
    $breadcrumb[] = ['label' => $page->title, 'url' => null];
    @endphp
    @include('partials.breadcrumb', ['items' => $breadcrumb])
</div>

@if($page->featured_image)
<section class="hero aurora">
    <div class="wrap hero-inner">
        @if($page->subtitle)
        <span class="eyebrow" style="color: var(--gold-light);">{{ $page->subtitle }}</span>
        @endif
        <h1 class="display">{{ $page->title }}</h1>
    </div>
</section>
<div class="hero-image-overlap">
    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" loading="lazy" decoding="async">
</div>
@else
<div class="wrap page-header" style="max-width: 800px;">
    @if($page->subtitle)
    <span class="eyebrow">{{ $page->subtitle }}</span>
    @endif
    <h1 class="reveal">{{ $page->title }}</h1>
</div>
@endif

@if($page->video_url || $page->video_file)
<div class="wrap" style="padding-top: 32px;">
    <div class="video-frame">
        @if($page->video_url)
        <iframe src="{{ $page->video_embed_url }}" title="{{ $page->title }}"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen loading="lazy"></iframe>
        @else
        <video controls autoplay muted preload="metadata" style="width:100%; height:100%;">
            <source src="{{ asset('storage/' . $page->video_file) }}" type="video/mp4">
            Browser kamu tidak mendukung pemutaran video.
        </video>
        @endif
    </div>
</div>
@endif

<div class="wrap" style="padding: 32px 0 48px; max-width: 800px;">
    <article class="content-body">
        @if(trim(strip_tags($page->body ?? '')) !== '')
        {!! $page->body !!}
        @else
        <div class="empty-state">Konten halaman ini belum diisi. Silakan cek kembali nanti.</div>
        @endif
    </article>
</div>

@endsection