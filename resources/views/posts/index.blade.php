@extends('layouts.app')

@section('title', 'Berita & Kegiatan SD Khadijah Wonorejo')

@section('content')

    <div class="wrap page-header">
        <h1 class="reveal">Berita &amp; Kegiatan</h1>

        @if($posts->isEmpty())
            <p style="color: var(--muted);">Belum ada berita.</p>
        @else
            <div class="grid-cards" style="margin-top: 28px;">
                @foreach($posts as $post)
                    @include('partials.post-card', ['post' => $post])
                @endforeach
            </div>

            <div style="margin-top: 40px;">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

@endsection