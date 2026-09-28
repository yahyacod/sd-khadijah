{{-- Pakai: @include('partials.post-card', ['post' => $post]) --}}
<a href="{{ route('posts.show', $post->slug) }}" class="card news-card reveal">
    <div class="news-card-media">
        @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
        @else
            <div class="news-card-placeholder"></div>
        @endif
        <div class="news-card-overlay"></div>
        <div class="news-card-text">
            @if($post->published_at)
                <span class="news-card-date">{{ $post->published_at->translatedFormat('d M Y') }}</span>
            @endif
            <h3>{{ $post->title }}</h3>
        </div>
    </div>
</a>