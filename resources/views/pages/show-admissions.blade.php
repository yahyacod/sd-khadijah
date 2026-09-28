@extends('layouts.app')

@section('title', $page->title . ' SD Khadijah Wonorejo')

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

<section class="hero aurora">
    <div class="wrap hero-inner">
        @if($page->subtitle)
        <span class="eyebrow" style="color: var(--gold-light);">{{ $page->subtitle }}</span>
        @endif
        <h1 class="display">{{ $page->title }}</h1>

        @if($page->cta_label && $page->cta_url)
        <a href="{{ $page->cta_url }}" target="_blank" rel="noopener" class="btn btn-gold" style="margin-top: 22px;">
            {{ $page->cta_label }} &rarr;
        </a>
        @endif
    </div>
</section>

@if($page->featured_image)
<div class="hero-image-overlap">
    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" loading="lazy" decoding="async">
</div>
@endif

<div class="wrap" style="padding: 48px 0; max-width: 800px;">
    <article class="content-body">
        @if(trim(strip_tags($page->body ?? '')) !== '')
        {!! $page->body !!}
        @else
        <div class="empty-state">Konten halaman ini belum diisi.</div>
        @endif
    </article>

    @if($page->cta_label && $page->cta_url)
    <div class="card cta-box reveal">
        <h2 style="font-size: 1.2rem;">Tertarik daftar di SD Khadijah Wonorejo?</h2>
        <a href="{{ $page->cta_url }}" target="_blank" rel="noopener" class="btn btn-green" style="margin-top: 14px;">
            {{ $page->cta_label }} &rarr;
        </a>
    </div>
    @endif
</div>

@endsection