<article class="sd-content-preview">
    <div class="sd-content-preview__topline">
        <span>{{ $contentType }}</span>
        <span class="sd-content-preview__status {{ $status === 'publish' ? 'is-published' : 'is-draft' }}">
            {{ $status === 'publish' ? 'Terbit' : 'Draft' }}
        </span>
    </div>

    @if (filled($imageUrl))
        <img class="sd-content-preview__image" src="{{ $imageUrl }}" alt="">
    @else
        <div class="sd-content-preview__image sd-content-preview__image--empty">
            <span>Foto utama akan tampil di sini</span>
        </div>
    @endif

    <div class="sd-content-preview__content">
        @if ($template === 'admissions')
            <span class="sd-content-preview__eyebrow">Informasi Pendaftaran</span>
        @endif

        <h2>{{ filled($title) ? $title : 'Judul konten Anda' }}</h2>

        @if (filled($subtitle))
            <p class="sd-content-preview__subtitle">{{ $subtitle }}</p>
        @endif

        <p class="sd-content-preview__url">
            {{ rtrim(config('app.url'), '/') }}/{{ $contentType === 'Berita' ? 'berita/' : '' }}{{ $slug ?: 'alamat-halaman' }}
        </p>

        <div class="sd-content-preview__body content-body">
            @if (filled($body))
                {!! $body !!}
            @else
                <p>Isi konten yang Anda tulis akan tampil di bagian ini.</p>
            @endif
        </div>

        @if ($template === 'admissions')
            <div class="sd-content-preview__cta">{{ $ctaLabel ?: 'Tombol ajakan pendaftaran' }}</div>
        @endif
    </div>
</article>
